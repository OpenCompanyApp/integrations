<?php

namespace OpenCompany\Integrations\Fathom;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * Fathom Analytics API service.
 *
 * Handles authentication and HTTP communication with the Fathom Analytics REST API.
 * Supports Bearer token authentication and configurable base URL for self-hosted instances.
 *
 * @see https://usefathom.com/api
 */
class FathomService
{
    /**
     * Create a new FathomService instance.
     *
     * @param  string  $accessToken  Fathom API access token (Bearer auth).
     * @param  string  $baseUrl  Base URL for the Fathom API (default: https://api.usefathom.com/v1).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.usefathom.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all sites in the Fathom account.
     *
     * @param  int  $limit  Maximum number of sites to return (default: 20).
     * @param  string|null  $startingAfter  Cursor for pagination; site ID to start after.
     * @param  string|null  $endingBefore  Cursor for pagination; site ID to end before.
     * @return array<string, mixed> API response data.
     *
     * @see https://usefathom.com/api
     */
    public function listSites(int $limit = 10, ?string $startingAfter = null, ?string $endingBefore = null): array
    {
        $params = $this->paginationParams($limit, $startingAfter, $endingBefore);

        return $this->request('GET', '/sites', $params);
    }

    /**
     * Get a single site by its ID.
     *
     * @param  string  $siteId  The Fathom site ID.
     * @return array<string, mixed> API response data.
     *
     * @see https://usefathom.com/api
     */
    public function getSite(string $siteId): array
    {
        return $this->request('GET', '/sites/' . rawurlencode($siteId));
    }

    /**
     * Create a Fathom site.
     *
     * @param  array<string, mixed>  $params  Payload parameters (name, sharing, share_password).
     * @return array<string, mixed>
     */
    public function createSite(array $params): array
    {
        return $this->request('POST', '/sites', $params);
    }

    /**
     * Update a Fathom site.
     *
     * @param  string  $siteId  Fathom site ID.
     * @param  array<string, mixed>  $params  Payload parameters (name, sharing, share_password).
     * @return array<string, mixed>
     */
    public function updateSite(string $siteId, array $params): array
    {
        return $this->request('POST', '/sites/' . rawurlencode($siteId), $params);
    }

    /**
     * Wipe all pageviews and event completions for a site.
     *
     * @param  string  $siteId  Fathom site ID.
     * @return array<string, mixed>
     */
    public function wipeSite(string $siteId): array
    {
        return $this->request('DELETE', '/sites/' . rawurlencode($siteId) . '/data');
    }

    /**
     * Delete a Fathom site.
     *
     * @param  string  $siteId  Fathom site ID.
     * @return array<string, mixed>
     */
    public function deleteSite(string $siteId): array
    {
        return $this->request('DELETE', '/sites/' . rawurlencode($siteId));
    }

    /**
     * Get aggregated analytics data for a site.
     *
     * @param  string  $siteId  The site ID to aggregate data for.
     * @param  string|null  $dateFrom  Start date (ISO 8601).
     * @param  string|null  $dateTo  End date (ISO 8601).
     * @param  string|null  $metrics  Comma-separated aggregates (e.g., "pageviews,visits,uniques,bounce_rate").
     * @param  string|null  $sortBy  Sort field and direction (e.g., "pageviews:desc").
     * @param  string|null  $groupBy  Group results by one or more fields (e.g., "pathname,country_code").
     * @param  int|null  $limit  Maximum number of grouped results.
     * @param  string|null  $dateGrouping  Optional date grouping such as hour, day, month, or year.
     * @param  string|null  $timezone  IANA timezone used for date grouping.
     * @param  string|null  $filters  JSON encoded Fathom aggregation filters.
     * @return array<string, mixed> API response data.
     *
     * @see https://usefathom.com/api
     */
    public function getAggregate(
        string $siteId,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        ?string $metrics = null,
        ?string $sortBy = null,
        ?string $groupBy = null,
        ?int $limit = null,
        ?string $dateGrouping = null,
        ?string $timezone = null,
        ?string $filters = null,
    ): array {
        $params = [
            'entity' => 'pageview',
            'entity_id' => $siteId,
            'aggregates' => $metrics ?? 'pageviews,visits,uniques,bounce_rate',
        ];

        if ($dateFrom !== null) {
            $params['date_from'] = $dateFrom;
        }
        if ($dateTo !== null) {
            $params['date_to'] = $dateTo;
        }
        if ($sortBy !== null) {
            $params['sort_by'] = $sortBy;
        }
        if ($groupBy !== null) {
            $params['field_grouping'] = $groupBy;
        }
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($dateGrouping !== null) {
            $params['date_grouping'] = $dateGrouping;
        }
        if ($timezone !== null) {
            $params['timezone'] = $timezone;
        }
        if ($filters !== null) {
            $params['filters'] = $filters;
        }

        return $this->request('GET', '/aggregations', $params);
    }

    /**
     * Generate an aggregation for pageview or event entities.
     *
     * @param  array<string, mixed>  $params  Aggregation query parameters.
     * @return array<string, mixed>
     */
    public function getAggregation(array $params): array
    {
        return $this->request('GET', '/aggregations', $params);
    }

    /**
     * List events for a site with optional filtering and pagination.
     *
     * @param  string  $siteId  The site ID to query events for.
     * @param  int  $limit  Maximum number of events to return.
     * @param  string|null  $startingAfter  Cursor for pagination.
     * @param  string|null  $endingBefore  Cursor for pagination.
     * @return array<string, mixed> API response data.
     *
     * @see https://usefathom.com/api
     */
    public function listEvents(string $siteId, int $limit = 10, ?string $startingAfter = null, ?string $endingBefore = null): array
    {
        return $this->request('GET', '/sites/' . rawurlencode($siteId) . '/events', $this->paginationParams($limit, $startingAfter, $endingBefore));
    }

    /**
     * Get a single event.
     *
     * @param  string  $siteId  Fathom site ID.
     * @param  string  $eventId  Fathom event ID.
     * @return array<string, mixed>
     */
    public function getEvent(string $siteId, string $eventId): array
    {
        return $this->request('GET', '/sites/' . rawurlencode($siteId) . '/events/' . rawurlencode($eventId));
    }

    /**
     * Create an event.
     *
     * @param  string  $siteId  Fathom site ID.
     * @param  string  $name  Event name.
     * @return array<string, mixed>
     */
    public function createEvent(string $siteId, string $name): array
    {
        return $this->request('POST', '/sites/' . rawurlencode($siteId) . '/events', ['name' => $name]);
    }

    /**
     * Update an event.
     *
     * @param  string  $siteId  Fathom site ID.
     * @param  string  $eventId  Fathom event ID.
     * @param  array<string, mixed>  $params  Payload parameters (name).
     * @return array<string, mixed>
     */
    public function updateEvent(string $siteId, string $eventId, array $params): array
    {
        return $this->request('POST', '/sites/' . rawurlencode($siteId) . '/events/' . rawurlencode($eventId), $params);
    }

    /**
     * Wipe completion data belonging to an event.
     *
     * @param  string  $siteId  Fathom site ID.
     * @param  string  $eventId  Fathom event ID.
     * @return array<string, mixed>
     */
    public function wipeEvent(string $siteId, string $eventId): array
    {
        return $this->request('DELETE', '/sites/' . rawurlencode($siteId) . '/events/' . rawurlencode($eventId) . '/data');
    }

    /**
     * Delete an event.
     *
     * @param  string  $siteId  Fathom site ID.
     * @param  string  $eventId  Fathom event ID.
     * @return array<string, mixed>
     */
    public function deleteEvent(string $siteId, string $eventId): array
    {
        return $this->request('DELETE', '/sites/' . rawurlencode($siteId) . '/events/' . rawurlencode($eventId));
    }

    /**
     * List milestones for a site.
     *
     * @param  string  $siteId  Fathom site ID.
     * @param  int  $limit  Maximum number of milestones to return.
     * @param  string|null  $startingAfter  Cursor for pagination.
     * @param  string|null  $endingBefore  Cursor for pagination.
     * @return array<string, mixed>
     */
    public function listMilestones(string $siteId, int $limit = 10, ?string $startingAfter = null, ?string $endingBefore = null): array
    {
        return $this->request('GET', '/sites/' . rawurlencode($siteId) . '/milestones', $this->paginationParams($limit, $startingAfter, $endingBefore));
    }

    /**
     * Get a milestone.
     *
     * @param  string  $siteId  Fathom site ID.
     * @param  string  $milestoneId  Fathom milestone ID.
     * @return array<string, mixed>
     */
    public function getMilestone(string $siteId, string $milestoneId): array
    {
        return $this->request('GET', '/sites/' . rawurlencode($siteId) . '/milestones/' . rawurlencode($milestoneId));
    }

    /**
     * Create a milestone.
     *
     * @param  string  $siteId  Fathom site ID.
     * @param  array<string, mixed>  $params  Payload parameters (name, milestone_date).
     * @return array<string, mixed>
     */
    public function createMilestone(string $siteId, array $params): array
    {
        return $this->request('POST', '/sites/' . rawurlencode($siteId) . '/milestones', $params);
    }

    /**
     * Update a milestone.
     *
     * @param  string  $siteId  Fathom site ID.
     * @param  string  $milestoneId  Fathom milestone ID.
     * @param  array<string, mixed>  $params  Payload parameters (name, milestone_date).
     * @return array<string, mixed>
     */
    public function updateMilestone(string $siteId, string $milestoneId, array $params): array
    {
        return $this->request('POST', '/sites/' . rawurlencode($siteId) . '/milestones/' . rawurlencode($milestoneId), $params);
    }

    /**
     * Delete a milestone.
     *
     * @param  string  $siteId  Fathom site ID.
     * @param  string  $milestoneId  Fathom milestone ID.
     * @return array<string, mixed>
     */
    public function deleteMilestone(string $siteId, string $milestoneId): array
    {
        return $this->request('DELETE', '/sites/' . rawurlencode($siteId) . '/milestones/' . rawurlencode($milestoneId));
    }

    /**
     * Get current visitors for a site.
     *
     * @param  string  $siteId  Fathom site ID.
     * @param  bool  $detailed  Include detailed top pages and referrer data.
     * @return array<string, mixed>
     */
    public function getCurrentVisitors(string $siteId, bool $detailed = false): array
    {
        return $this->request('GET', '/current_visitors', [
            'site_id' => $siteId,
            'detailed' => $detailed ? 'true' : null,
        ]);
    }

    /**
     * Get the authenticated account profile.
     *
     * @return array<string, mixed> API response data.
     *
     * @see https://usefathom.com/api
     */
    public function getAccount(): array
    {
        return $this->request('GET', '/account');
    }

    /**
     * Get the authenticated account profile.
     *
     * @return array<string, mixed> API response data.
     */
    public function getCurrentUser(): array
    {
        return $this->getAccount();
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (relative to base URL).
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed> Parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Fathom API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (relative to base URL).
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return Response Raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing, the request fails, or a connection error occurs.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (! $this->accessToken) {
            throw new RuntimeException('Fathom access token is not configured.');
        }

        $url = $this->baseUrl . $path;
        $data = array_filter($data, static fn (mixed $value): bool => $value !== null && $value !== '');

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Fathom API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new RuntimeException("Fathom API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Fathom API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new RuntimeException("Fathom API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Fathom API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Fathom API: {$e->getMessage()}");
        }
    }

    /**
     * Build cursor pagination query parameters.
     *
     * @return array<string, mixed>
     */
    private function paginationParams(int $limit = 10, ?string $startingAfter = null, ?string $endingBefore = null): array
    {
        return [
            'limit' => max(1, min($limit, 100)),
            'starting_after' => $startingAfter,
            'ending_before' => $endingBefore,
        ];
    }
}
