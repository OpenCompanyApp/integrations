<?php

namespace OpenCompany\Integrations\Splunk;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SplunkService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://localhost:8089/services',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Create a new search job.
     *
     * @param  string  $query  The SPL search query.
     * @param  string|null  $earliestTime  Earliest time for the search (e.g., "-24h", "2025-01-01T00:00:00").
     * @param  string|null  $latestTime  Latest time for the search (e.g., "now", "2025-01-31T23:59:59").
     * @return array<string, mixed> The search job response containing the SID.
     */
    public function search(string $query, ?string $earliestTime = null, ?string $latestTime = null): array
    {
        $data = ['search' => $query];

        if ($earliestTime !== null) {
            $data['earliest_time'] = $earliestTime;
        }

        if ($latestTime !== null) {
            $data['latest_time'] = $latestTime;
        }

        return $this->request('POST', '/search/jobs', $data);
    }

    /**
     * Get results from a completed search job.
     *
     * @param  string  $sid  The search job ID.
     * @param  int  $offset  The offset for pagination (0-based).
     * @param  int  $count  The number of results to return per page.
     * @return array<string, mixed> The search results.
     */
    public function getSearchResults(string $sid, int $offset = 0, int $count = 100): array
    {
        return $this->request('GET', '/search/jobs/' . urlencode($sid) . '/results', [
            'offset' => $offset,
            'count' => $count,
            'output_mode' => 'json',
        ]);
    }

    /**
     * List all indexes.
     *
     * @return array<string, mixed> The list of indexes.
     */
    public function listIndexes(): array
    {
        return $this->request('GET', '/data/indexes', [
            'output_mode' => 'json',
        ]);
    }

    /**
     * Get details for a specific index.
     *
     * @param  string  $name  The index name.
     * @return array<string, mixed> The index details.
     */
    public function getIndex(string $name): array
    {
        return $this->request('GET', '/data/indexes/' . urlencode($name), [
            'output_mode' => 'json',
        ]);
    }

    /**
     * List all saved searches.
     *
     * @return array<string, mixed> The list of saved searches.
     */
    public function listSavedSearches(): array
    {
        return $this->request('GET', '/saved/searches', [
            'output_mode' => 'json',
        ]);
    }

    /**
     * Get the current authenticated user context.
     *
     * @return array<string, mixed> The current user information.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/authentication/current-context', [
            'output_mode' => 'json',
        ]);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  The API endpoint path.
     * @param  array<string, mixed>  $data  Request parameters or body.
     * @return array<string, mixed> The parsed JSON response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        $body = $response->body();
        $json = $response->json();

        if ($json !== null) {
            return $json;
        }

        // Splunk sometimes returns non-JSON (e.g., Atom feeds). Return raw body as a message.
        return ['raw' => $body];
    }

    /**
     * Make a raw HTTP request to the Splunk REST API.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  The API endpoint path.
     * @param  array<string, mixed>  $data  Request parameters or body.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the access token is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Splunk access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])->timeout(30)->withOptions([
                'verify' => false, // Splunk self-signed certs are common
            ]);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->asForm()->post($url, $data),
                'PUT' => $http->asForm()->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('messages.0.text') ?? $response->body();
                Log::error("Splunk API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Splunk API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Splunk API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Splunk API: {$e->getMessage()}");
        }
    }
}
