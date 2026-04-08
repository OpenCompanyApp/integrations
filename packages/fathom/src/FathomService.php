<?php

namespace OpenCompany\Integrations\Fathom;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Fathom Analytics API service.
 *
 * Handles authentication and HTTP communication with the Fathom Analytics REST API.
 * Supports Bearer token authentication and configurable base URL for self-hosted instances.
 *
 * @see https://.usefathom.com/docs/api
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
     * @param  int|null  $startingAfter  Cursor for pagination — site ID to start after.
     * @return array<string, mixed> API response data.
     *
     * @see https://usefathom.com/docs/api/sites#list-sites
     */
    public function listSites(int $limit = 20, ?int $startingAfter = null): array
    {
        $params = ['limit' => $limit];
        if ($startingAfter !== null) {
            $params['starting_after'] = $startingAfter;
        }

        return $this->request('GET', '/sites', $params);
    }

    /**
     * Get a single site by its ID.
     *
     * @param  string  $siteId  The Fathom site ID.
     * @return array<string, mixed> API response data.
     *
     * @see https://usefathom.com/docs/api/sites#get-site
     */
    public function getSite(string $siteId): array
    {
        return $this->request('GET', '/sites/' . urlencode($siteId));
    }

    /**
     * List pageviews for a site with optional filtering and pagination.
     *
     * @param  string  $siteId  The site ID to query pageviews for.
     * @param  string|null  $dateFrom  Start date (ISO 8601, e.g., "2025-01-01").
     * @param  string|null  $dateTo  End date (ISO 8601, e.g., "2025-01-31").
     * @param  int  $limit  Maximum number of pageviews to return (default: 20).
     * @param  int|null  $startingAfter  Cursor for pagination — pageview ID to start after.
     * @return array<string, mixed> API response data.
     *
     * @see https://usefathom.com/docs/api/pageviews
     */
    public function listPageviews(
        string $siteId,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        int $limit = 20,
        ?int $startingAfter = null,
    ): array {
        $params = [
            'site_id' => $siteId,
            'limit' => $limit,
        ];

        if ($dateFrom !== null) {
            $params['date_from'] = $dateFrom;
        }
        if ($dateTo !== null) {
            $params['date_to'] = $dateTo;
        }
        if ($startingAfter !== null) {
            $params['starting_after'] = $startingAfter;
        }

        return $this->request('GET', '/pageviews', $params);
    }

    /**
     * Get aggregated analytics data for a site.
     *
     * @param  string  $siteId  The site ID to aggregate data for.
     * @param  string  $dateFrom  Start date (ISO 8601).
     * @param  string  $dateTo  End date (ISO 8601).
     * @param  string|null  $metrics  Comma-separated metrics (e.g., "pageviews,visits,visitors,bounce_rate").
     * @param  string|null  $sortBy  Sort field and direction (e.g., "pageviews:desc").
     * @param  string|null  $groupBy  Group results by a dimension (e.g., "page_hostname", "page_path", "referrer_hostname", "country", "browser", "device_type").
     * @param  int|null  $limit  Maximum number of grouped results.
     * @return array<string, mixed> API response data.
     *
     * @see https://usefathom.com/docs/api/aggregations
     */
    public function getAggregate(
        string $siteId,
        string $dateFrom,
        string $dateTo,
        ?string $metrics = null,
        ?string $sortBy = null,
        ?string $groupBy = null,
        ?int $limit = null,
    ): array {
        $params = [
            'site_id' => $siteId,
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
        ];

        if ($metrics !== null) {
            $params['metrics'] = $metrics;
        }
        if ($sortBy !== null) {
            $params['sort_by'] = $sortBy;
        }
        if ($groupBy !== null) {
            $params['group_by'] = $groupBy;
        }
        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        return $this->request('GET', '/aggregates', $params);
    }

    /**
     * List events for a site with optional filtering and pagination.
     *
     * @param  string  $siteId  The site ID to query events for.
     * @param  int  $limit  Maximum number of events to return (default: 20).
     * @param  int|null  $startingAfter  Cursor for pagination — event ID to start after.
     * @return array<string, mixed> API response data.
     *
     * @see https://usefathom.com/docs/api/events
     */
    public function listEvents(
        string $siteId,
        int $limit = 20,
        ?int $startingAfter = null,
    ): array {
        $params = [
            'site_id' => $siteId,
            'limit' => $limit,
        ];

        if ($startingAfter !== null) {
            $params['starting_after'] = $startingAfter;
        }

        return $this->request('GET', '/events', $params);
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed> API response data.
     *
     * @see https://usefathom.com/docs/api/users
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
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
     * @return \Illuminate\Http\Client\Response Raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing, the request fails, or a connection error occurs.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Fathom access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Fathom API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Fathom API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Fathom API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Fathom API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Fathom API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Fathom API: {$e->getMessage()}");
        }
    }
}
