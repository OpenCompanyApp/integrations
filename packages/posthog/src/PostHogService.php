<?php

namespace OpenCompany\Integrations\PostHog;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * PostHog API service for interacting with the PostHog platform.
 *
 * Handles authentication, HTTP communication, and error handling for all
 * PostHog API endpoints including events, persons, feature flags, insights,
 * dashboards, and cohorts.
 */
class PostHogService
{
    /**
     * Create a new PostHogService instance.
     *
     * @param  string  $apiToken  The Personal Access Token or Project API Key for authenticating with PostHog.
     * @param  string  $baseUrl   The base URL of the PostHog instance (default: https://us.posthog.com).
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://us.posthog.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the PostHog integration is properly configured.
     *
     * @return bool True if an API token is set, false otherwise.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiToken);
    }

    // ─── Events ───────────────────────────────────────────────────────

    /**
     * Capture (send) a single event to PostHog.
     *
     * This endpoint uses the project API key for authentication rather than
     * the personal access token. The event is sent to the /e/ capture endpoint.
     *
     * @param  string  $distinctId  The unique identifier for the user/actor.
     * @param  string  $event       The name of the event (e.g., "pageview", "signup").
     * @param  array   $properties  Optional properties to attach to the event.
     * @param  string|null  $timestamp  Optional ISO 8601 timestamp for the event.
     * @return array The parsed JSON response from the capture endpoint.
     */
    public function captureEvent(string $distinctId, string $event, array $properties = [], ?string $timestamp = null): array
    {
        $payload = [
            'distinct_id' => $distinctId,
            'event' => $event,
            'properties' => $properties,
        ];

        if ($timestamp !== null) {
            $payload['timestamp'] = $timestamp;
        }

        return $this->request('POST', '/e/', $payload);
    }

    /**
     * List events from PostHog with optional filtering and pagination.
     *
     * @param  int     $limit       Maximum number of events to return (default: 100).
     * @param  int     $offset      Number of events to skip for pagination (default: 0).
     * @param  string|null  $event   Filter by event name.
     * @param  string|null  $distinctId  Filter by distinct user ID.
     * @param  string|null  $personId    Filter by internal person UUID.
     * @param  string|null  $after    Only events after this timestamp (ISO 8601).
     * @param  string|null  $before   Only events before this timestamp (ISO 8601).
     * @return array The parsed JSON response containing events list.
     */
    public function listEvents(int $limit = 100, int $offset = 0, ?string $event = null, ?string $distinctId = null, ?string $personId = null, ?string $after = null, ?string $before = null): array
    {
        $params = [
            'limit' => $limit,
            'offset' => $offset,
        ];

        if ($event !== null) {
            $params['event'] = $event;
        }
        if ($distinctId !== null) {
            $params['distinct_id'] = $distinctId;
        }
        if ($personId !== null) {
            $params['person_id'] = $personId;
        }
        if ($after !== null) {
            $params['after'] = $after;
        }
        if ($before !== null) {
            $params['before'] = $before;
        }

        return $this->request('GET', '/api/event', $params);
    }

    /**
     * Get a single event by its ID.
     *
     * @param  string  $eventId  The unique identifier of the event.
     * @return array The parsed JSON response containing the event details.
     */
    public function getEvent(string $eventId): array
    {
        return $this->request('GET', '/api/event/' . urlencode($eventId));
    }

    // ─── Persons ──────────────────────────────────────────────────────

    /**
     * List persons from PostHog with optional search and pagination.
     *
     * @param  int     $limit   Maximum number of persons to return (default: 100).
     * @param  int     $offset  Number of persons to skip for pagination (default: 0).
     * @param  string|null  $search  Search query to filter persons by name or email.
     * @return array The parsed JSON response containing persons list.
     */
    public function listPersons(int $limit = 100, int $offset = 0, ?string $search = null): array
    {
        $params = [
            'limit' => $limit,
            'offset' => $offset,
        ];

        if ($search !== null) {
            $params['search'] = $search;
        }

        return $this->request('GET', '/api/person', $params);
    }

    /**
     * Get a single person by their ID.
     *
     * @param  string  $personId  The unique identifier (UUID) of the person.
     * @return array The parsed JSON response containing the person details.
     */
    public function getPerson(string $personId): array
    {
        return $this->request('GET', '/api/person/' . urlencode($personId));
    }

    // ─── Feature Flags ────────────────────────────────────────────────

    /**
     * List all feature flags in the project.
     *
     * @param  int  $limit   Maximum number of feature flags to return (default: 100).
     * @param  int  $offset  Number of feature flags to skip for pagination (default: 0).
     * @return array The parsed JSON response containing feature flags list.
     */
    public function listFeatureFlags(int $limit = 100, int $offset = 0): array
    {
        return $this->request('GET', '/api/feature_flag', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get a single feature flag by its ID.
     *
     * @param  int  $flagId  The unique identifier of the feature flag.
     * @return array The parsed JSON response containing the feature flag details.
     */
    public function getFeatureFlag(int $flagId): array
    {
        return $this->request('GET', '/api/feature_flag/' . $flagId);
    }

    /**
     * Create a new feature flag.
     *
     * @param  string  $name               Human-readable name for the feature flag.
     * @param  string  $key                 Unique key used to reference the flag in code.
     * @param  bool    $active              Whether the flag is active (default: true).
     * @param  array|null  $filters         Optional filter conditions for the flag.
     * @param  int|null   $rolloutPercentage  Optional rollout percentage (0–100) for gradual release.
     * @return array The parsed JSON response containing the created feature flag.
     */
    public function createFeatureFlag(string $name, string $key, bool $active = true, ?array $filters = null, ?int $rolloutPercentage = null): array
    {
        $data = [
            'name' => $name,
            'key' => $key,
            'active' => $active,
        ];

        if ($filters !== null) {
            $data['filters'] = $filters;
        }
        if ($rolloutPercentage !== null) {
            $data['rollout_percentage'] = $rolloutPercentage;
        }

        return $this->request('POST', '/api/feature_flag', $data);
    }

    /**
     * Update an existing feature flag.
     *
     * @param  int        $flagId  The unique identifier of the feature flag to update.
     * @param  bool|null  $active  Set the flag active state.
     * @param  array|null $filters Set new filter conditions.
     * @param  int|null   $rolloutPercentage  Set a new rollout percentage (0–100).
     * @return array The parsed JSON response containing the updated feature flag.
     */
    public function updateFeatureFlag(int $flagId, ?bool $active = null, ?array $filters = null, ?int $rolloutPercentage = null): array
    {
        $data = [];

        if ($active !== null) {
            $data['active'] = $active;
        }
        if ($filters !== null) {
            $data['filters'] = $filters;
        }
        if ($rolloutPercentage !== null) {
            $data['rollout_percentage'] = $rolloutPercentage;
        }

        return $this->request('PATCH', '/api/feature_flag/' . $flagId, $data);
    }

    /**
     * Delete a feature flag.
     *
     * @param  int  $flagId  The unique identifier of the feature flag to delete.
     * @return array The parsed JSON response (typically empty on success).
     */
    public function deleteFeatureFlag(int $flagId): array
    {
        return $this->request('DELETE', '/api/feature_flag/' . $flagId);
    }

    // ─── Insights ─────────────────────────────────────────────────────

    /**
     * List insights in the project.
     *
     * @param  int          $limit   Maximum number of insights to return (default: 100).
     * @param  int          $offset  Number of insights to skip for pagination (default: 0).
     * @param  string|null  $type    Filter by insight type (e.g., "TRENDS", "FUNNELS", "RETENTION", "PATHS").
     * @return array The parsed JSON response containing insights list.
     */
    public function listInsights(int $limit = 100, int $offset = 0, ?string $type = null): array
    {
        $params = [
            'limit' => $limit,
            'offset' => $offset,
        ];

        if ($type !== null) {
            $params['type'] = $type;
        }

        return $this->request('GET', '/api/insight', $params);
    }

    /**
     * Get a single insight by its ID.
     *
     * @param  int  $insightId  The unique identifier of the insight.
     * @return array The parsed JSON response containing the insight details.
     */
    public function getInsight(int $insightId): array
    {
        return $this->request('GET', '/api/insight/' . $insightId);
    }

    // ─── Dashboards ───────────────────────────────────────────────────

    /**
     * List dashboards in the project.
     *
     * @param  int  $limit   Maximum number of dashboards to return (default: 100).
     * @param  int  $offset  Number of dashboards to skip for pagination (default: 0).
     * @return array The parsed JSON response containing dashboards list.
     */
    public function listDashboards(int $limit = 100, int $offset = 0): array
    {
        return $this->request('GET', '/api/dashboard', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get a single dashboard by its ID.
     *
     * @param  int  $dashboardId  The unique identifier of the dashboard.
     * @return array The parsed JSON response containing the dashboard details.
     */
    public function getDashboard(int $dashboardId): array
    {
        return $this->request('GET', '/api/dashboard/' . $dashboardId);
    }

    // ─── Cohorts ──────────────────────────────────────────────────────

    /**
     * List cohorts in the project.
     *
     * @param  int  $limit   Maximum number of cohorts to return (default: 100).
     * @param  int  $offset  Number of cohorts to skip for pagination (default: 0).
     * @return array The parsed JSON response containing cohorts list.
     */
    public function listCohorts(int $limit = 100, int $offset = 0): array
    {
        return $this->request('GET', '/api/cohort', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    // ─── Test Connection ──────────────────────────────────────────────

    /**
     * Test the connection to the PostHog API by fetching the current user.
     *
     * @return array Associative array with 'success' (bool), 'message' (string),
     *               and optionally 'email' (string) on success or 'error' on failure.
     */
    public function testConnection(): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($this->baseUrl . '/api/users/@me');

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "PostHog API returned HTTP {$response->status()}.",
                ];
            }

            $data = $response->json();
            $email = $data['email'] ?? ($data['first_name'] ?? 'Unknown user');

            return [
                'success' => true,
                'message' => "Connected to PostHog as {$email}.",
                'email' => $email,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    // ─── HTTP Layer ───────────────────────────────────────────────────

    /**
     * Make an API request and return the parsed JSON response.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, PATCH, DELETE).
     * @param  string  $path    The API path (e.g., "/api/event").
     * @param  array   $data    Query parameters or request body payload.
     * @return array The parsed JSON response body.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the PostHog API.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, PATCH, DELETE).
     * @param  string  $path    The API path (e.g., "/api/event").
     * @param  array   $data    Query parameters or request body payload.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API token is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiToken) {
            throw new \RuntimeException('PostHog API token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("PostHog API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("PostHog API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('detail') ?? $response->json('error') ?? $body;
                Log::error("PostHog API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("PostHog API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("PostHog API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to PostHog API: {$e->getMessage()}");
        }
    }
}
