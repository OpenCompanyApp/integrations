<?php

namespace OpenCompany\Integrations\Mixpanel;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Mixpanel REST and Ingestion APIs.
 *
 * Wraps HTTP calls to Mixpanel's query, funnel, retention, profile,
 * export, cohort, and JQL endpoints using HTTP Basic Auth with a
 * service account (username + secret).
 */
class MixpanelService
{
    private const BASE_URL = 'https://mixpanel.com/api/2.0';
    private const DATA_URL = 'https://data.mixpanel.com/api/2.0';
    private const TRACK_URL = 'https://api.mixpanel.com';

    /**
     * @param  string  $username   Mixpanel service-account username
     * @param  string  $secret     Mixpanel service-account secret (or API secret)
     * @param  string  $projectId  Mixpanel project ID
     */
    public function __construct(
        private string $username = '',
        private string $secret = '',
        private string $projectId = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->username) && ! empty($this->secret);
    }

    // ── Connection Test ─────────────────────────────────────

    /**
     * Test the connection by performing a minimal query request.
     *
     * Returns success if the credentials are valid and the API responds.
     *
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(): array
    {
        try {
            $response = $this->request('GET', '/query', [
                'from_date' => date('Y-m-d', strtotime('-1 day')),
                'to_date'   => date('Y-m-d'),
                'event'     => '[]',
            ]);

            return [
                'success' => true,
                'message' => 'Connected to Mixpanel API.',
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'error'   => $e->getMessage(),
            ];
        }
    }

    // ── Events ──────────────────────────────────────────────

    /**
     * Track an event to Mixpanel via the Ingestion API.
     *
     * @param  string  $event        Event name
     * @param  array<string, mixed>  $properties  Event properties
     * @param  string  $distinctId   Optional distinct user ID
     * @param  int|null  $time       Optional Unix timestamp for the event
     * @return array<string, mixed>
     */
    public function trackEvent(string $event, array $properties = [], string $distinctId = '', ?int $time = null): array
    {
        $payload = [
            'event'      => $event,
            'properties' => array_merge($properties, array_filter([
                'distinct_id' => $distinctId,
                'time'        => $time,
                'token'       => $this->secret,
            ])),
        ];

        return $this->requestIngest('POST', '/track', [$payload]);
    }

    // ── Query ───────────────────────────────────────────────

    /**
     * Query Mixpanel event data.
     *
     * @param  string  $fromDate  Start date (YYYY-MM-DD)
     * @param  string  $toDate    End date (YYYY-MM-DD)
     * @param  string|array<string>  $event  Event name(s)
     * @param  string  $type      Query type: "general", "unique", or "average"
     * @param  string  $unit      Time unit: "minute", "hour", "day", "week", "month"
     * @return array<string, mixed>
     */
    public function query(string $fromDate, string $toDate, string|array $event = [], string $type = 'general', string $unit = 'day'): array
    {
        $params = [
            'from_date' => $fromDate,
            'to_date'   => $toDate,
            'event'     => is_array($event) ? json_encode($event) : $event,
            'type'      => $type,
            'unit'      => $unit,
        ];

        return $this->request('GET', '/query', $params);
    }

    // ── Funnels ─────────────────────────────────────────────

    /**
     * Get funnel results for a specific funnel.
     *
     * @param  int|string  $funnelId  Funnel ID
     * @param  string  $fromDate  Start date (YYYY-MM-DD)
     * @param  string  $toDate    End date (YYYY-MM-DD)
     * @param  string  $unit      Time unit: "day", "week", "month"
     * @return array<string, mixed>
     */
    public function funnel(int|string $funnelId, string $fromDate, string $toDate, string $unit = 'day'): array
    {
        return $this->request('GET', '/funnels', [
            'funnel_id' => (int) $funnelId,
            'from_date' => $fromDate,
            'to_date'   => $toDate,
            'unit'      => $unit,
        ]);
    }

    /**
     * List all funnels in the project.
     *
     * @param  int|string|null  $projectId  Project ID (defaults to configured project)
     * @return array<string, mixed>
     */
    public function listFunnels(int|string|null $projectId = null): array
    {
        return $this->request('GET', '/funnels/list', array_filter([
            'project_id' => $projectId ?? ($this->projectId ?: null),
        ]));
    }

    // ── Retention ───────────────────────────────────────────

    /**
     * Get retention data for a cohort of users.
     *
     * @param  string  $fromDate       Start date (YYYY-MM-DD)
     * @param  string  $toDate         End date (YYYY-MM-DD)
     * @param  string  $retentionType  Retention type: "birth" or "compounded"
     * @param  string  $bornEvent      The event that defines cohort entry
     * @param  string  $bornWhere      Optional filter expression for born event
     * @return array<string, mixed>
     */
    public function retention(string $fromDate, string $toDate, string $retentionType = 'birth', string $bornEvent = '', string $bornWhere = ''): array
    {
        $params = array_filter([
            'from_date'      => $fromDate,
            'to_date'        => $toDate,
            'retention_type' => $retentionType,
            'born_event'     => $bornEvent,
            'born_where'     => $bornWhere,
        ]);

        return $this->request('GET', '/retention', $params);
    }

    // ── Profiles (Engage) ───────────────────────────────────

    /**
     * Set or update a user profile via the Engage API.
     *
     * @param  string  $distinctId  The user's distinct ID
     * @param  array<string, mixed>  $properties  Profile properties to set
     * @param  string  $operation   Profile operation: "set", "set_once", "add", "append", "union", "unset", "delete"
     * @return array<string, mixed>
     */
    public function profile(string $distinctId, array $properties = [], string $operation = 'set'): array
    {
        $payload = [
            '$token'       => $this->secret,
            '$distinct_id' => $distinctId,
            '$' . $operation => $properties,
        ];

        return $this->requestEngage('POST', '/engage', [$payload]);
    }

    // ── Export ──────────────────────────────────────────────

    /**
     * Export raw event data from Mixpanel.
     *
     * Uses the data export endpoint at data.mixpanel.com.
     *
     * @param  string  $fromDate  Start date (YYYY-MM-DD)
     * @param  string  $toDate    End date (YYYY-MM-DD)
     * @param  string|array<string>  $event  Event name(s) to export (empty = all)
     * @return array<string, mixed>
     */
    public function getExport(string $fromDate, string $toDate, string|array $event = []): array
    {
        $params = array_filter([
            'from_date' => $fromDate,
            'to_date'   => $toDate,
            'event'     => is_array($event) ? json_encode($event) : ($event ?: null),
        ]);

        return $this->requestData('GET', '/export', $params);
    }

    // ── Cohorts ─────────────────────────────────────────────

    /**
     * List all cohorts in the project.
     *
     * @param  int|string|null  $projectId  Project ID (defaults to configured project)
     * @return array<string, mixed>
     */
    public function listCohorts(int|string|null $projectId = null): array
    {
        return $this->request('GET', '/cohorts/list', array_filter([
            'project_id' => $projectId ?? ($this->projectId ?: null),
        ]));
    }

    // ── JQL ─────────────────────────────────────────────────

    /**
     * Execute a JQL (JavaScript Query Language) script.
     *
     * @param  string  $script  JQL script to execute
     * @param  array<string, mixed>  $params  Parameters to pass into the script
     * @return array<string, mixed>
     */
    public function queryJql(string $script, array $params = []): array
    {
        return $this->request('POST', '/jql', [
            'script' => $script,
            'params' => json_encode($params),
        ]);
    }

    // ── Current User ────────────────────────────────────────

    /**
     * Retrieve basic account/project info for the authenticated user.
     *
     * Uses the /query endpoint with minimal params to confirm identity and access.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/query', [
            'from_date' => date('Y-m-d', strtotime('-1 day')),
            'to_date'   => date('Y-m-d'),
            'event'     => '[]',
        ]);
    }

    // ── HTTP Helpers ─────────────────────────────────────────

    /**
     * Make an authenticated API request to the Mixpanel API.
     *
     * @param  string  $method  HTTP method (GET, POST)
     * @param  string  $path    API endpoint path
     * @param  array<string, mixed>  $params  Query or body parameters
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $params = []): array
    {
        $this->ensureConfigured();

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withBasicAuth($this->username, $this->secret)
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'  => $http->get($url, $params),
                'POST' => $http->asForm()->post($url, $params),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            return $this->handleResponse($response, $method, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Mixpanel API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new \RuntimeException("Failed to connect to Mixpanel API: {$e->getMessage()}");
        }
    }

    /**
     * Make an authenticated request to the data export endpoint.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path    API endpoint path
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>
     */
    private function requestData(string $method, string $path, array $params = []): array
    {
        $this->ensureConfigured();

        $url = self::DATA_URL . $path;

        try {
            $http = Http::withBasicAuth($this->username, $this->secret)
                ->timeout(60);

            $response = match (strtoupper($method)) {
                'GET'  => $http->get($url, $params),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            return $this->handleResponse($response, $method, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Mixpanel data API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new \RuntimeException("Failed to connect to Mixpanel data API: {$e->getMessage()}");
        }
    }

    /**
     * Send a tracking event to the Mixpanel Ingestion API.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path    API endpoint path
     * @param  array<int, array<string, mixed>>  $data  Array of event payloads
     * @return array<string, mixed>
     */
    private function requestIngest(string $method, string $path, array $data): array
    {
        $url = self::TRACK_URL . $path;

        try {
            $http = Http::asJson()->timeout(30);

            $response = match (strtoupper($method)) {
                'POST' => $http->post($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            return $this->handleResponse($response, $method, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Mixpanel ingest API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new \RuntimeException("Failed to connect to Mixpanel ingest API: {$e->getMessage()}");
        }
    }

    /**
     * Send an engage (profile) request to the Mixpanel Engage API.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path    API endpoint path
     * @param  array<int, array<string, mixed>>  $data  Array of profile operations
     * @return array<string, mixed>
     */
    private function requestEngage(string $method, string $path, array $data): array
    {
        $url = self::TRACK_URL . $path;

        try {
            $response = Http::asJson()
                ->timeout(30)
                ->post($url, $data);

            return $this->handleResponse($response, $method, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Mixpanel engage API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new \RuntimeException("Failed to connect to Mixpanel engage API: {$e->getMessage()}");
        }
    }

    /**
     * Handle an API response and return parsed data.
     *
     * @param  \Illuminate\Http\Client\Response  $response
     * @param  string  $method  HTTP method used
     * @param  string  $path    API path called
     * @return array<string, mixed>
     */
    private function handleResponse($response, string $method, string $path): array
    {
        $body = $response->json() ?? [];

        if ($response->failed()) {
            $error = is_string($body) ? $body : ($body['error'] ?? $response->body());

            Log::error("Mixpanel API error: {$method} {$path}", [
                'status' => $response->status(),
                'error'  => $error,
            ]);

            throw new \RuntimeException("Mixpanel API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
        }

        return is_array($body) ? $body : ['data' => $body];
    }

    /**
     * Ensure the service is properly configured before making requests.
     *
     * @throws \RuntimeException if credentials are missing
     */
    private function ensureConfigured(): void
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Mixpanel service-account credentials are not configured.');
        }
    }
}
