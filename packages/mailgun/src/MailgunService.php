<?php

namespace OpenCompany\Integrations\Mailgun;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Mailgun REST API covering email sending, events, stats, domains, mailing lists, and suppressions.
 *
 * Wraps HTTP calls to Mailgun's v3 API endpoints with Bearer token authentication
 * passed via the Authorization header on every request.
 */
class MailgunService
{
    /**
     * @param  string  $apiKey   Mailgun API key
     * @param  string  $domain   Mailgun sending domain (e.g. mg.example.com)
     * @param  string  $baseUrl  Mailgun API base URL
     */
    public function __construct(
        private string $apiKey = '',
        private string $domain = '',
        private string $baseUrl = 'https://api.mailgun.net/v3',
    ) {}

    /**
     * Check whether the service has the minimum required configuration.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey) && ! empty($this->domain);
    }

    // ── Connection ──────────────────────────────────────────

    /**
     * Test the connection by fetching the list of domains and returning the count.
     *
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(): array
    {
        try {
            $result = $this->request('GET', '/domains');
            $total = $result['total_count'] ?? count($result['items'] ?? []);

            return [
                'success' => true,
                'message' => "Connected to Mailgun. {$total} domain(s) found.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    // ── Email ───────────────────────────────────────────────

    /**
     * Send an email through Mailgun.
     *
     * @param  array<string, mixed>  $params  Email parameters (to, from, subject, text, html, cc, bcc, tags)
     * @return array<string, mixed>
     */
    public function sendEmail(array $params): array
    {
        return $this->request('POST', "/{$this->domain}/messages", $params);
    }

    // ── Events ──────────────────────────────────────────────

    /**
     * Get events for the domain.
     *
     * @param  array<string, mixed>  $params  Query params (event, limit, begin, end, recipient)
     * @return array<string, mixed>
     */
    public function getEvents(array $params = []): array
    {
        return $this->request('GET', "/{$this->domain}/events", $params);
    }

    // ── Stats ───────────────────────────────────────────────

    /**
     * Get total stats for the domain.
     *
     * @param  array<string, mixed>  $params  Query params (event, start, end, resolution)
     * @return array<string, mixed>
     */
    public function getStats(array $params = []): array
    {
        return $this->request('GET', "/{$this->domain}/stats/total", $params);
    }

    // ── Domains ─────────────────────────────────────────────

    /**
     * List all domains in the Mailgun account.
     *
     * @param  array<string, mixed>  $params  Query params (limit, page)
     * @return array<string, mixed>
     */
    public function listDomains(array $params = []): array
    {
        return $this->request('GET', '/domains', $params);
    }

    /**
     * Get details for a single domain.
     *
     * @param  string  $name  Domain name (e.g. mg.example.com)
     * @return array<string, mixed>
     */
    public function getDomain(string $name): array
    {
        return $this->request('GET', "/domains/{$name}");
    }

    // ── Mailing Lists ───────────────────────────────────────

    /**
     * List all mailing lists.
     *
     * @param  array<string, mixed>  $params  Query params (limit, page)
     * @return array<string, mixed>
     */
    public function listMailingLists(array $params = []): array
    {
        return $this->request('GET', '/lists', $params);
    }

    /**
     * Create a new mailing list.
     *
     * @param  array<string, mixed>  $data  List fields (address, name, description)
     * @return array<string, mixed>
     */
    public function createMailingList(array $data): array
    {
        return $this->request('POST', '/lists', $data);
    }

    /**
     * List members of a mailing list.
     *
     * @param  string                 $listAddress  Mailing list address
     * @param  array<string, mixed>   $params       Query params (limit)
     * @return array<string, mixed>
     */
    public function listMembers(string $listAddress, array $params = []): array
    {
        return $this->request('GET', "/lists/{$listAddress}/members", $params);
    }

    /**
     * Add a member to a mailing list.
     *
     * @param  string                 $listAddress  Mailing list address
     * @param  array<string, mixed>   $data         Member fields (address, name, vars)
     * @return array<string, mixed>
     */
    public function addMember(string $listAddress, array $data): array
    {
        return $this->request('POST', "/lists/{$listAddress}/members", $data);
    }

    /**
     * Add multiple members to a mailing list in bulk.
     *
     * Uses upsert mode — existing members are updated.
     *
     * @param  string                   $listAddress  Mailing list address
     * @param  array<int, mixed>        $members      Array of member objects, each with at least an "address" key
     * @return array<string, mixed>
     */
    public function addMemberBulk(string $listAddress, array $members): array
    {
        return $this->request('POST', "/lists/{$listAddress}/members.json", [
            'members' => json_encode($members),
            'upsert'  => 'true',
        ]);
    }

    // ── Suppressions ────────────────────────────────────────

    /**
     * Get bounces (suppressions) for a domain.
     *
     * @param  string                 $domain  Domain name
     * @param  array<string, mixed>   $params  Query params (limit)
     * @return array<string, mixed>
     */
    public function getSuppressions(string $domain, array $params = []): array
    {
        return $this->request('GET', "/{$domain}/bounces", $params);
    }

    /**
     * Create a bounce (suppression) for an address on a domain.
     *
     * @param  string                 $domain  Domain name
     * @param  array<string, mixed>   $data    Suppression fields (address, code, error)
     * @return array<string, mixed>
     */
    public function createSuppression(string $domain, array $data): array
    {
        return $this->request('POST', "/{$domain}/bounces", $data);
    }

    // ── User / Account ──────────────────────────────────────

    /**
     * Get current account info (domains list used as a health check).
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/domains');
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to Mailgun.
     *
     * Sends Bearer token via Authorization header on every request.
     *
     * @param  string                 $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string                 $path    API path (e.g. /{domain}/messages, /domains)
     * @param  array<string, mixed>  $data    Query params (GET) or form body (POST/PUT)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Mailgun API key and domain are not configured.');
        }

        $baseUrl = rtrim($this->baseUrl, '/');
        $url = $baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->asForm()->post($url, $data),
                'PUT'    => $http->asForm()->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                Log::error("Mailgun API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);

                throw new \RuntimeException("Mailgun API error ({$response->status()}): {$response->body()}");
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Mailgun API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Mailgun API: {$e->getMessage()}");
        }
    }
}
