<?php

namespace OpenCompany\Integrations\Hunter;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Hunter.io REST API covering domain search, email finding,
 * email verification, email counting, lead management, and account info.
 *
 * Authentication uses an API key passed as a query parameter (api_key=...).
 */
class HunterService
{
    private const BASE_URL = 'https://api.hunter.io/v2';

    /**
     * @param string $apiKey Hunter.io API key
     */
    public function __construct(
        private string $apiKey = '',
    ) {}

    /**
     * Check whether the API key is configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    // ── Domain Search ──────────────────────────────────

    /**
     * Search for email addresses associated with a domain.
     *
     * @param  string               $domain  The domain to search (e.g., "example.com").
     * @param  int|null             $limit   Maximum number of results (default: 10, max: 100).
     * @param  int|null             $offset  Number of results to skip for pagination.
     * @param  string|null          $type    Email type filter: "personal" or "generic".
     * @return array<string, mixed>
     */
    public function domainSearch(string $domain, ?int $limit = null, ?int $offset = null, ?string $type = null): array
    {
        $params = array_filter([
            'domain' => $domain,
            'limit' => $limit,
            'offset' => $offset,
            'type' => $type,
        ], fn ($value) => $value !== null);

        return $this->request('GET', '/domain-search', $params);
    }

    // ── Email Finder ───────────────────────────────────

    /**
     * Find the most likely email address for a person based on domain and name.
     *
     * @param  string               $domain     The company domain (e.g., "example.com").
     * @param  string|null          $firstName  The person's first name.
     * @param  string|null          $lastName   The person's last name.
     * @return array<string, mixed>
     */
    public function emailFinder(string $domain, ?string $firstName = null, ?string $lastName = null): array
    {
        $params = array_filter([
            'domain' => $domain,
            'first_name' => $firstName,
            'last_name' => $lastName,
        ], fn ($value) => $value !== null);

        return $this->request('GET', '/email-finder', $params);
    }

    // ── Email Verifier ─────────────────────────────────

    /**
     * Verify the deliverability of an email address.
     *
     * @param  string               $email  The email address to verify.
     * @return array<string, mixed>
     */
    public function emailVerifier(string $email): array
    {
        return $this->request('GET', '/email-verifier', ['email' => $email]);
    }

    // ── Email Count ────────────────────────────────────

    /**
     * Get the number of email addresses found for a domain.
     *
     * @param  string               $domain  The domain to count emails for.
     * @return array<string, mixed>
     */
    public function emailCount(string $domain): array
    {
        return $this->request('GET', '/email-count', ['domain' => $domain]);
    }

    // ── Leads ──────────────────────────────────────────

    /**
     * List leads with optional pagination.
     *
     * @param  int|null             $limit   Maximum number of leads to return (default: 20, max: 100).
     * @param  int|null             $offset  Number of leads to skip for pagination.
     * @return array<string, mixed>
     */
    public function listLeads(?int $limit = null, ?int $offset = null): array
    {
        $params = array_filter([
            'limit' => $limit,
            'offset' => $offset,
        ], fn ($value) => $value !== null);

        return $this->request('GET', '/leads', $params);
    }

    /**
     * Get a single lead by ID.
     *
     * @param  int                  $leadId  The lead ID.
     * @return array<string, mixed>
     */
    public function getLead(int $leadId): array
    {
        return $this->request('GET', "/leads/{$leadId}");
    }

    /**
     * Create a new lead.
     *
     * @param  string               $email      Lead email address.
     * @param  string|null          $firstName  Lead first name.
     * @param  string|null          $lastName   Lead last name.
     * @param  int|null             $listId     ID of the lead list to add the lead to.
     * @return array<string, mixed>
     */
    public function createLead(string $email, ?string $firstName = null, ?string $lastName = null, ?int $listId = null): array
    {
        $payload = array_filter([
            'email' => $email,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'list_id' => $listId,
        ], fn ($value) => $value !== null);

        return $this->request('POST', '/leads', $payload);
    }

    // ── Account ────────────────────────────────────────

    /**
     * Get information about the authenticated user and account, including API usage.
     *
     * @return array<string, mixed>
     */
    public function getAccount(): array
    {
        return $this->request('GET', '/account');
    }

    // ── HTTP ───────────────────────────────────────────

    /**
     * Send an authenticated request to the Hunter.io API.
     *
     * @param  string                $method  HTTP method (GET, POST, PUT, PATCH, DELETE).
     * @param  string                $path    API path (e.g., /domain-search).
     * @param  array<string, mixed>  $data    Query params (GET) or JSON body (POST/PUT/PATCH).
     * @return array<string, mixed>
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Hunter API key is not configured.');
        }

        // Hunter uses api_key as a query parameter, so always include it
        $data['api_key'] = $this->apiKey;

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'PATCH'  => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->failed()) {
                $body = $response->json();
                $message = $body['errors'][0]['details'] ?? $body['errors'][0]['id'] ?? $response->body();

                Log::error('Hunter API error', [
                    'method' => $method,
                    'path'   => $path,
                    'status' => $response->status(),
                    'body'   => $body,
                ]);

                throw new \RuntimeException("Hunter API error ({$response->status()}): {$message}");
            }

            return $response->json() ?? [];
        } catch (ConnectionException $e) {
            Log::error('Hunter connection error', ['method' => $method, 'path' => $path, 'error' => $e->getMessage()]);
            throw new \RuntimeException("Hunter connection error: {$e->getMessage()}");
        }
    }
}
