<?php

namespace OpenCompany\Integrations\Mailgun;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Mailgun v3 REST API covering email delivery, domains, events, statistics,
 * mailing lists, members, and suppressions (bounces).
 *
 * Authentication uses a Bearer API key via the Authorization header.
 * The base URL defaults to the US region but can be switched to the EU endpoint.
 */
class MailgunService
{
    /** @var string The base URL for the Mailgun API (US or EU region). */
    private string $baseUrl;

    /**
     * @param string $apiKey  Mailgun API key.
     * @param string $domain  The Mailgun domain used for message operations (e.g. "mg.example.com").
     * @param string $baseUrl The Mailgun API base URL (default: US region).
     */
    public function __construct(
        private string $apiKey = '',
        private string $domain = '',
        string $baseUrl = 'https://api.mailgun.net/v3',
    ) {
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    /**
     * Check whether the API key is configured.
     *
     * @return bool
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    // ── Email ───────────────────────────────────────────

    /**
     * Send an email via the Mailgun Messages API.
     *
     * POST /{domain}/messages — returns the send status including message ID.
     *
     * @param  string|array<int, string> $to               Recipient email address(es).
     * @param  string                    $from              Sender email address.
     * @param  string                    $subject           Email subject line.
     * @param  string|null               $text              Plain-text body content.
     * @param  string|null               $html              HTML body content.
     * @param  string|array<int, string> $cc                CC recipient email address(es).
     * @param  string|array<int, string> $bcc               BCC recipient email address(es).
     * @param  array<int, string>        $tags              Tags to attach to the message.
     * @param  array<string, mixed>      $customVariables   Custom variables for event webhooks.
     * @param  array<int, string>        $attachmentUrls    URLs of attachments to fetch and attach.
     * @return array<string, mixed>      The API response including message ID.
     */
    public function sendEmail(
        string|array $to,
        string $from,
        string $subject,
        ?string $text = null,
        ?string $html = null,
        string|array $cc = [],
        string|array $bcc = [],
        array $tags = [],
        array $customVariables = [],
        array $attachmentUrls = [],
    ): array {
        $payload = array_filter([
            'to' => is_array($to) ? implode(',', $to) : $to,
            'from' => $from,
            'subject' => $subject,
            'text' => $text,
            'html' => $html,
            'cc' => is_array($cc) && ! empty($cc) ? implode(',', $cc) : (is_string($cc) && $cc !== '' ? $cc : null),
            'bcc' => is_array($bcc) && ! empty($bcc) ? implode(',', $bcc) : (is_string($bcc) && $bcc !== '' ? $bcc : null),
        ], fn ($value) => $value !== null);

        if (! empty($tags)) {
            $payload['o:tag'] = $tags;
        }

        foreach ($customVariables as $key => $value) {
            $payload["v:{$key}"] = is_string($value) ? $value : json_encode($value);
        }

        if (! empty($attachmentUrls)) {
            $payload['attachment'] = $attachmentUrls;
        }

        return $this->request('POST', "/{$this->domain}/messages", $payload);
    }

    // ── Events ──────────────────────────────────────────

    /**
     * Get events for the configured domain.
     *
     * GET /{domain}/events — returns a paginated list of events.
     *
     * @param  string|null  $event     Filter by event type (e.g. "accepted", "delivered", "failed").
     * @param  int|null     $limit     Maximum number of events to return.
     * @param  string|null  $begin     Start timestamp (RFC 2822 or Unix epoch).
     * @param  string|null  $end       End timestamp (RFC 2822 or Unix epoch).
     * @param  string|null  $recipient Filter by recipient email address.
     * @param  string|null  $subject   Filter by email subject.
     * @return array<string, mixed>
     */
    public function getEvents(
        ?string $event = null,
        ?int $limit = null,
        ?string $begin = null,
        ?string $end = null,
        ?string $recipient = null,
        ?string $subject = null,
    ): array {
        $params = array_filter([
            'event' => $event,
            'limit' => $limit,
            'begin' => $begin,
            'end' => $end,
            'recipient' => $recipient,
            'subject' => $subject,
        ], fn ($value) => $value !== null);

        return $this->request('GET', "/{$this->domain}/events", $params);
    }

    // ── Stats ───────────────────────────────────────────

    /**
     * Get total statistics for the configured domain.
     *
     * GET /{domain}/stats/total — returns aggregated delivery stats.
     *
     * @param  string|null  $event      Event type to query (e.g. "accepted", "delivered", "failed").
     * @param  string|null  $start      Start date (RFC 2822 or YYYY-MM-DD).
     * @param  string|null  $end        End date (RFC 2822 or YYYY-MM-DD).
     * @param  string|null  $resolution Time resolution: hour, day, or month.
     * @param  string|null  $duration   Duration string (e.g. "30d").
     * @return array<string, mixed>
     */
    public function getStats(
        ?string $event = null,
        ?string $start = null,
        ?string $end = null,
        ?string $resolution = null,
        ?string $duration = null,
    ): array {
        $params = array_filter([
            'event' => $event,
            'start' => $start,
            'end' => $end,
            'resolution' => $resolution,
            'duration' => $duration,
        ], fn ($value) => $value !== null);

        return $this->request('GET', "/{$this->domain}/stats/total", $params);
    }

    // ── Domains ─────────────────────────────────────────

    /**
     * List all domains in the Mailgun account.
     *
     * GET /domains — returns a paginated list of domains.
     *
     * @param  int|null $limit Maximum number of domains to return.
     * @param  int|null $page  Page number for pagination.
     * @return array<string, mixed>
     */
    public function listDomains(?int $limit = null, ?int $page = null): array
    {
        $params = array_filter([
            'limit' => $limit,
            'page' => $page,
        ], fn ($value) => $value !== null);

        return $this->request('GET', '/domains', $params);
    }

    /**
     * Get details for a single domain.
     *
     * GET /domains/{name} — returns domain info, DNS records, and receiving settings.
     *
     * @param  string $domain The domain name to retrieve.
     * @return array<string, mixed>
     */
    public function getDomain(string $domain): array
    {
        return $this->request('GET', "/domains/{$domain}");
    }

    // ── Mailing Lists ───────────────────────────────────

    /**
     * List all mailing lists.
     *
     * GET /lists — returns a paginated list of mailing lists.
     *
     * @param  int|null $limit Maximum number of lists to return.
     * @param  int|null $page  Page number for pagination.
     * @return array<string, mixed>
     */
    public function listMailingLists(?int $limit = null, ?int $page = null): array
    {
        $params = array_filter([
            'limit' => $limit,
            'page' => $page,
        ], fn ($value) => $value !== null);

        return $this->request('GET', '/lists', $params);
    }

    /**
     * Create a new mailing list.
     *
     * POST /lists — creates a mailing list and returns its details.
     *
     * @param  string      $address      The mailing list address (e.g. "newsletter@mg.example.com").
     * @param  string|null $name         Display name for the mailing list.
     * @param  string|null $description  Description of the mailing list.
     * @param  string|null $accessLevel  Access level: readonly, members, everyone.
     * @return array<string, mixed>
     */
    public function createMailingList(
        string $address,
        ?string $name = null,
        ?string $description = null,
        ?string $accessLevel = null,
    ): array {
        $payload = array_filter([
            'address' => $address,
            'name' => $name,
            'description' => $description,
            'access_level' => $accessLevel,
        ], fn ($value) => $value !== null);

        return $this->request('POST', '/lists', $payload);
    }

    // ── Mailing List Members ────────────────────────────

    /**
     * List members of a mailing list.
     *
     * GET /lists/{address}/members — returns a paginated list of members.
     *
     * @param  string   $listAddress The mailing list address.
     * @param  int|null $limit       Maximum number of members to return.
     * @return array<string, mixed>
     */
    public function listMembers(string $listAddress, ?int $limit = null): array
    {
        $params = array_filter([
            'limit' => $limit,
        ], fn ($value) => $value !== null);

        return $this->request('GET', "/lists/{$listAddress}/members", $params);
    }

    /**
     * Add a single member to a mailing list.
     *
     * POST /lists/{address}/members — creates or updates a member.
     *
     * @param  string               $listAddress The mailing list address.
     * @param  string               $address     The member's email address.
     * @param  string|null          $name        The member's display name.
     * @param  array<string, mixed> $vars        Custom variables for the member.
     * @return array<string, mixed>
     */
    public function addMember(
        string $listAddress,
        string $address,
        ?string $name = null,
        array $vars = [],
    ): array {
        $payload = array_filter([
            'address' => $address,
            'name' => $name,
            'vars' => ! empty($vars) ? json_encode($vars) : null,
            'subscribed' => true,
            'upsert' => true,
        ], fn ($value) => $value !== null);

        return $this->request('POST', "/lists/{$listAddress}/members", $payload);
    }

    /**
     * Add multiple members to a mailing list in bulk (with upsert).
     *
     * POST /lists/{address}/members.json — creates or updates members in bulk.
     *
     * @param  string               $listAddress The mailing list address.
     * @param  array<int, array<string, mixed>> $members Array of member data (each with at least "address").
     * @return array<string, mixed>
     */
    public function addMemberBulk(string $listAddress, array $members): array
    {
        $payload = [
            'members' => json_encode($members),
            'upsert' => true,
        ];

        return $this->request('POST', "/lists/{$listAddress}/members.json", $payload);
    }

    // ── Suppressions (Bounces) ──────────────────────────

    /**
     * List bounce suppressions for a domain.
     *
     * GET /{domain}/bounces — returns a paginated list of bounced addresses.
     *
     * @param  string   $domain The domain to query bounces for.
     * @param  int|null $limit  Maximum number of bounces to return.
     * @return array<string, mixed>
     */
    public function getSuppressions(string $domain, ?int $limit = null): array
    {
        $params = array_filter([
            'limit' => $limit,
        ], fn ($value) => $value !== null);

        return $this->request('GET', "/{$domain}/bounces", $params);
    }

    /**
     * Create a bounce suppression for an address.
     *
     * POST /{domain}/bounces — adds an address to the bounce list.
     *
     * @param  string      $domain The domain to add the suppression to.
     * @param  string      $address The email address to suppress.
     * @param  int|null    $code    SMTP bounce code (e.g. 550).
     * @param  string|null $error   Human-readable error message.
     * @return array<string, mixed>
     */
    public function createSuppression(
        string $domain,
        string $address,
        ?int $code = null,
        ?string $error = null,
    ): array {
        $payload = array_filter([
            'address' => $address,
            'code' => $code,
            'error' => $error,
        ], fn ($value) => $value !== null);

        return $this->request('POST', "/{$domain}/bounces", $payload);
    }

    // ── Connection Test ─────────────────────────────────

    /**
     * List domains for connection testing.
     *
     * GET /domains — used by testConnection to verify API key validity.
     *
     * @return array<string, mixed>
     */
    public function getDomains(): array
    {
        return $this->request('GET', '/domains');
    }

    // ── HTTP ────────────────────────────────────────────

    /**
     * Send an authenticated request to the Mailgun API.
     *
     * @param  string                $method HTTP method (GET, POST, PUT, PATCH, DELETE).
     * @param  string                $path   API path (e.g. /{domain}/messages).
     * @param  array<string, mixed>  $data   Query params (GET/DELETE) or form body (POST/PUT/PATCH).
     * @return array<string, mixed>
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Mailgun API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withToken($this->apiKey, 'Bearer')
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->failed()) {
                $body = $response->json();
                $message = $body['message'] ?? $response->body();

                Log::error('Mailgun API error', [
                    'method' => $method,
                    'path' => $path,
                    'status' => $response->status(),
                    'body' => $body,
                ]);

                throw new \RuntimeException("Mailgun API error ({$response->status()}): {$message}");
            }

            return $response->json() ?? [];
        } catch (ConnectionException $e) {
            Log::error('Mailgun connection error', ['method' => $method, 'path' => $path, 'error' => $e->getMessage()]);
            throw new \RuntimeException("Mailgun connection error: {$e->getMessage()}");
        }
    }
}
