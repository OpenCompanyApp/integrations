<?php

namespace OpenCompany\Integrations\Splunk;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Splunk management REST API.
 *
 * Handles bearer-token authentication, form-encoded requests, JSON response
 * parsing, and safe relative API helpers for Splunk services endpoints.
 */
class SplunkService
{
    /**
     * @param  string  $accessToken  Splunk bearer token.
     * @param  string  $baseUrl  Splunk REST services base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://localhost:8089/services',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Determine whether an access token is available.
     */
    public function isConfigured(): bool
    {
        return $this->accessToken !== '';
    }

    /**
     * Create a new asynchronous search job.
     *
     * @param  string  $query  SPL search query.
     * @param  string|null  $earliestTime  Optional earliest time.
     * @param  string|null  $latestTime  Optional latest time.
     * @param  string  $execMode  Splunk execution mode.
     * @param  array<string, mixed>  $options  Additional search/jobs parameters.
     * @return array<string, mixed>
     */
    public function search(string $query, ?string $earliestTime = null, ?string $latestTime = null, string $execMode = 'normal', array $options = []): array
    {
        $data = array_merge($options, [
            'search' => $query,
            'exec_mode' => $execMode,
        ]);

        if ($earliestTime !== null && $earliestTime !== '') {
            $data['earliest_time'] = $earliestTime;
        }

        if ($latestTime !== null && $latestTime !== '') {
            $data['latest_time'] = $latestTime;
        }

        return $this->apiPost('/search/jobs', $data);
    }

    /**
     * Run an export search and return the parsed or raw response.
     *
     * @param  string  $query  SPL search query.
     * @param  string|null  $earliestTime  Optional earliest time.
     * @param  string|null  $latestTime  Optional latest time.
     * @param  array<string, mixed>  $options  Additional export parameters.
     * @return array<string, mixed>
     */
    public function exportSearch(string $query, ?string $earliestTime = null, ?string $latestTime = null, array $options = []): array
    {
        $data = array_merge(['search' => $query], $options);

        if ($earliestTime !== null && $earliestTime !== '') {
            $data['earliest_time'] = $earliestTime;
        }

        if ($latestTime !== null && $latestTime !== '') {
            $data['latest_time'] = $latestTime;
        }

        return $this->apiPost('/search/jobs/export', $data);
    }

    /**
     * List search jobs visible to the authenticated user.
     *
     * @param  int  $count  Maximum number of jobs.
     * @param  int  $offset  Pagination offset.
     * @param  string|null  $search  Optional server-side search filter.
     * @return array<string, mixed>
     */
    public function listSearchJobs(int $count = 100, int $offset = 0, ?string $search = null): array
    {
        $query = ['count' => $count, 'offset' => $offset];
        if ($search !== null && $search !== '') {
            $query['search'] = $search;
        }

        return $this->apiGet('/search/jobs', $query);
    }

    /**
     * Get status and metadata for a search job.
     *
     * @param  string  $sid  Search job ID.
     * @return array<string, mixed>
     */
    public function getSearchJob(string $sid): array
    {
        return $this->apiGet('/search/jobs/' . rawurlencode($sid));
    }

    /**
     * Cancel or delete a search job.
     *
     * @param  string  $sid  Search job ID.
     * @return array<string, mixed>
     */
    public function deleteSearchJob(string $sid): array
    {
        return $this->apiDelete('/search/jobs/' . rawurlencode($sid));
    }

    /**
     * Get result rows from a completed search job.
     *
     * @param  string  $sid  Search job ID.
     * @param  int  $offset  Pagination offset.
     * @param  int  $count  Number of results.
     * @return array<string, mixed>
     */
    public function getSearchResults(string $sid, int $offset = 0, int $count = 100): array
    {
        return $this->apiGet('/search/jobs/' . rawurlencode($sid) . '/results', [
            'offset' => $offset,
            'count' => $count,
        ]);
    }

    /**
     * Get event rows from a completed search job.
     *
     * @param  string  $sid  Search job ID.
     * @param  int  $offset  Pagination offset.
     * @param  int  $count  Number of events.
     * @return array<string, mixed>
     */
    public function getSearchEvents(string $sid, int $offset = 0, int $count = 100): array
    {
        return $this->apiGet('/search/jobs/' . rawurlencode($sid) . '/events', [
            'offset' => $offset,
            'count' => $count,
        ]);
    }

    /**
     * Get the search.log text for a search job.
     *
     * @param  string  $sid  Search job ID.
     * @return array<string, mixed>
     */
    public function getSearchLog(string $sid): array
    {
        return $this->apiGet('/search/jobs/' . rawurlencode($sid) . '/search.log', [
            'output_mode' => 'raw',
        ]);
    }

    /**
     * List Splunk indexes.
     *
     * @param  int  $count  Maximum number of indexes.
     * @param  int  $offset  Pagination offset.
     * @return array<string, mixed>
     */
    public function listIndexes(int $count = 100, int $offset = 0): array
    {
        return $this->apiGet('/data/indexes', ['count' => $count, 'offset' => $offset]);
    }

    /**
     * Get details for a specific index.
     *
     * @param  string  $name  Index name.
     * @return array<string, mixed>
     */
    public function getIndex(string $name): array
    {
        return $this->apiGet('/data/indexes/' . rawurlencode($name));
    }

    /**
     * Create a Splunk index.
     *
     * @param  string  $name  Index name.
     * @param  array<string, mixed>  $options  Index creation parameters.
     * @return array<string, mixed>
     */
    public function createIndex(string $name, array $options = []): array
    {
        return $this->apiPost('/data/indexes', array_merge($options, ['name' => $name]));
    }

    /**
     * Update a Splunk index configuration.
     *
     * @param  string  $name  Index name.
     * @param  array<string, mixed>  $options  Index update parameters.
     * @return array<string, mixed>
     */
    public function updateIndex(string $name, array $options): array
    {
        return $this->apiPost('/data/indexes/' . rawurlencode($name), $options);
    }

    /**
     * Delete a Splunk index.
     *
     * @param  string  $name  Index name.
     * @return array<string, mixed>
     */
    public function deleteIndex(string $name): array
    {
        return $this->apiDelete('/data/indexes/' . rawurlencode($name));
    }

    /**
     * List saved searches.
     *
     * @param  int  $count  Maximum number of saved searches.
     * @param  int  $offset  Pagination offset.
     * @param  string|null  $search  Optional server-side search filter.
     * @return array<string, mixed>
     */
    public function listSavedSearches(int $count = 100, int $offset = 0, ?string $search = null): array
    {
        $query = ['count' => $count, 'offset' => $offset];
        if ($search !== null && $search !== '') {
            $query['search'] = $search;
        }

        return $this->apiGet('/saved/searches', $query);
    }

    /**
     * Get a saved search by name.
     *
     * @param  string  $name  Saved search name.
     * @return array<string, mixed>
     */
    public function getSavedSearch(string $name): array
    {
        return $this->apiGet('/saved/searches/' . rawurlencode($name));
    }

    /**
     * Create a saved search.
     *
     * @param  string  $name  Saved search name.
     * @param  string  $query  SPL search query.
     * @param  array<string, mixed>  $options  Saved-search parameters.
     * @return array<string, mixed>
     */
    public function createSavedSearch(string $name, string $query, array $options = []): array
    {
        return $this->apiPost('/saved/searches', array_merge($options, [
            'name' => $name,
            'search' => $query,
        ]));
    }

    /**
     * Update a saved search.
     *
     * @param  string  $name  Saved search name.
     * @param  array<string, mixed>  $options  Saved-search parameters.
     * @return array<string, mixed>
     */
    public function updateSavedSearch(string $name, array $options): array
    {
        return $this->apiPost('/saved/searches/' . rawurlencode($name), $options);
    }

    /**
     * Delete a saved search.
     *
     * @param  string  $name  Saved search name.
     * @return array<string, mixed>
     */
    public function deleteSavedSearch(string $name): array
    {
        return $this->apiDelete('/saved/searches/' . rawurlencode($name));
    }

    /**
     * Dispatch a saved search and return its generated search job.
     *
     * @param  string  $name  Saved search name.
     * @param  array<string, mixed>  $options  Dispatch parameters.
     * @return array<string, mixed>
     */
    public function dispatchSavedSearch(string $name, array $options = []): array
    {
        return $this->apiPost('/saved/searches/' . rawurlencode($name) . '/dispatch', $options);
    }

    /**
     * List installed Splunk apps.
     *
     * @param  int  $count  Maximum number of apps.
     * @param  int  $offset  Pagination offset.
     * @return array<string, mixed>
     */
    public function listApps(int $count = 100, int $offset = 0): array
    {
        return $this->apiGet('/apps/local', ['count' => $count, 'offset' => $offset]);
    }

    /**
     * Get an installed Splunk app.
     *
     * @param  string  $name  App name.
     * @return array<string, mixed>
     */
    public function getApp(string $name): array
    {
        return $this->apiGet('/apps/local/' . rawurlencode($name));
    }

    /**
     * List Splunk users.
     *
     * @param  int  $count  Maximum number of users.
     * @param  int  $offset  Pagination offset.
     * @return array<string, mixed>
     */
    public function listUsers(int $count = 100, int $offset = 0): array
    {
        return $this->apiGet('/authentication/users', ['count' => $count, 'offset' => $offset]);
    }

    /**
     * Get a Splunk user.
     *
     * @param  string  $username  Username.
     * @return array<string, mixed>
     */
    public function getUser(string $username): array
    {
        return $this->apiGet('/authentication/users/' . rawurlencode($username));
    }

    /**
     * Get the current authenticated user context.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->apiGet('/authentication/current-context');
    }

    /**
     * Get server information.
     *
     * @return array<string, mixed>
     */
    public function getServerInfo(): array
    {
        return $this->apiGet('/server/info');
    }

    /**
     * Make a safe relative GET request to the Splunk services API.
     *
     * @param  string  $path  Relative services path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, [], $query);
    }

    /**
     * Make a safe relative POST request to the Splunk services API.
     *
     * @param  string  $path  Relative services path.
     * @param  array<string, mixed>  $body  Form-encoded body parameters.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = [], array $query = []): array
    {
        return $this->request('POST', $path, $body, $query);
    }

    /**
     * Make a safe relative DELETE request to the Splunk services API.
     *
     * @param  string  $path  Relative services path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $path, [], $query);
    }

    /**
     * Make an API request and return parsed JSON or a raw body wrapper.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Relative services path.
     * @param  array<string, mixed>  $body  Form body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $body = [], array $query = []): array
    {
        $query = array_merge(['output_mode' => 'json'], $query);
        $response = $this->rawRequest($method, $path, $body, $query);
        $json = $response->json();

        if (is_array($json)) {
            return $json;
        }

        return ['raw' => $response->body()];
    }

    /**
     * Make a raw HTTP request to the Splunk REST API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Relative services path.
     * @param  array<string, mixed>  $body  Form body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return Response
     */
    private function rawRequest(string $method, string $path, array $body = [], array $query = []): Response
    {
        $url = $this->buildUrl($path, $query);

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->requireAccessToken(),
                'Accept' => 'application/json',
            ])->timeout(30)->withOptions(['verify' => false]);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                'POST' => $http->asForm()->post($url, $body),
                'DELETE' => $http->delete($url),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $error = $response->json('messages.0.text') ?? $response->json('messages.0.message') ?? $response->body();
                Log::error("Splunk API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Splunk API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Splunk API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new \RuntimeException("Failed to connect to Splunk API: {$e->getMessage()}");
        }
    }

    /**
     * Return the configured token or throw a clear error.
     */
    private function requireAccessToken(): string
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Splunk access token is not configured.');
        }

        return $this->accessToken;
    }

    /**
     * Build a full URL from a safe relative path and query parameters.
     *
     * @param  string  $path  Relative services path.
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function buildUrl(string $path, array $query): string
    {
        $path = '/' . ltrim($path, '/');

        if (str_contains($path, '://') || str_starts_with($path, '//') || str_contains($path, '..')) {
            throw new \RuntimeException('Splunk API path must be a safe relative services path.');
        }

        $query = array_filter($query, static fn ($value): bool => $value !== null && $value !== '');
        $queryString = $this->queryString($query);

        return $this->baseUrl . $path . ($queryString === '' ? '' : '?' . $queryString);
    }

    /**
     * Build a query string while preserving repeated array values.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function queryString(array $query): string
    {
        $parts = [];

        foreach ($query as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $entry) {
                    if ($entry !== null && $entry !== '') {
                        $parts[] = rawurlencode((string) $key) . '=' . rawurlencode((string) $entry);
                    }
                }

                continue;
            }

            $parts[] = rawurlencode((string) $key) . '=' . rawurlencode((string) $value);
        }

        return implode('&', $parts);
    }
}
