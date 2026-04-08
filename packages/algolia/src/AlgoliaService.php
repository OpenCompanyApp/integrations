<?php

namespace OpenCompany\Integrations\Algolia;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service class for interacting with the Algolia Search API.
 *
 * Handles authentication via X-Algolia-Application-Id and X-Algolia-API-Key headers.
 * Uses the write endpoint ({appId}.algolia.net) for write operations
 * and the search endpoint ({appId}-dsn.algolia.net) for search queries.
 */
class AlgoliaService
{
    private string $appId;
    private string $apiKey;
    private string $writeBaseUrl;
    private string $searchBaseUrl;

    /**
     * @param string $appId  Algolia Application ID
     * @param string $apiKey Algolia Admin API Key
     */
    public function __construct(string $appId = '', string $apiKey = '')
    {
        $this->appId = $appId;
        $this->apiKey = $apiKey;
        $this->writeBaseUrl = $appId ? "https://{$appId}.algolia.net/1" : '';
        $this->searchBaseUrl = $appId ? "https://{$appId}-dsn.algolia.net/1" : '';
    }

    /**
     * Check whether the service is configured with credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->appId) && !empty($this->apiKey);
    }

    /**
     * Get the Algolia Application ID.
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * Search an index using the Algolia search endpoint (read replica).
     *
     * @param string $indexName The index to search
     * @param array  $body      Search parameters (query, filters, hitsPerPage, etc.)
     * @return array<string, mixed>
     */
    public function search(string $indexName, array $body): array
    {
        return $this->request('POST', "/indexes/{$indexName}/query", $body, true);
    }

    /**
     * Get a single object by its objectID.
     *
     * @param string $indexName The index name
     * @param string $objectID  The object's unique identifier
     * @return array<string, mixed>
     */
    public function getObject(string $indexName, string $objectID): array
    {
        return $this->request('GET', "/indexes/{$indexName}/{$objectID}");
    }

    /**
     * Save (create or replace) an object in an index.
     *
     * @param string $indexName The index name
     * @param string $objectID  The object's unique identifier
     * @param array  $body      The object data to save
     * @return array<string, mixed>
     */
    public function saveObject(string $indexName, string $objectID, array $body): array
    {
        return $this->request('PUT', "/indexes/{$indexName}/{$objectID}", $body);
    }

    /**
     * Delete an object from an index.
     *
     * @param string $indexName The index name
     * @param string $objectID  The object's unique identifier
     * @return array<string, mixed>
     */
    public function deleteObject(string $indexName, string $objectID): array
    {
        return $this->request('DELETE', "/indexes/{$indexName}/{$objectID}");
    }

    /**
     * Partially update an object's attributes.
     *
     * @param string $indexName  The index name
     * @param string $objectID   The object's unique identifier
     * @param array  $attributes The attributes to update
     * @return array<string, mixed>
     */
    public function partialUpdate(string $indexName, string $objectID, array $attributes): array
    {
        return $this->request('POST', "/indexes/{$indexName}/{$objectID}/partial", $attributes);
    }

    /**
     * List all indices in the application.
     *
     * @return array<string, mixed>
     */
    public function listIndices(): array
    {
        return $this->request('GET', '/indexes');
    }

    /**
     * Get the settings of an index.
     *
     * @param string $indexName The index name
     * @return array<string, mixed>
     */
    public function getSettings(string $indexName): array
    {
        return $this->request('GET', "/indexes/{$indexName}/settings");
    }

    /**
     * Clear all objects from an index.
     *
     * @param string $indexName The index name
     * @return array<string, mixed>
     */
    public function clearIndex(string $indexName): array
    {
        return $this->request('POST', "/indexes/{$indexName}/clear");
    }

    /**
     * Perform a batch operation on an index.
     *
     * @param string $indexName The index name
     * @param array  $requests  Array of batch requests
     * @return array<string, mixed>
     */
    public function batch(string $indexName, array $requests): array
    {
        return $this->request('POST', "/indexes/{$indexName}/batch", [
            'requests' => $requests,
        ]);
    }

    /**
     * List API keys (used to verify authentication).
     *
     * @return array<string, mixed>
     */
    public function listApiKeys(): array
    {
        return $this->request('GET', '/keys');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param bool $useSearchEndpoint Whether to use the DSN (search) endpoint
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], bool $useSearchEndpoint = false): array
    {
        $response = $this->rawRequest($method, $path, $data, $useSearchEndpoint);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Algolia API.
     *
     * @param bool $useSearchEndpoint Whether to use the DSN (search) endpoint
     */
    private function rawRequest(string $method, string $path, array $data = [], bool $useSearchEndpoint = false): \Illuminate\Http\Client\Response
    {
        if (!$this->isConfigured()) {
            throw new \RuntimeException('Algolia is not configured. Application ID and API Key are required.');
        }

        $baseUrl = $useSearchEndpoint ? $this->searchBaseUrl : $this->writeBaseUrl;
        $url = $baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'X-Algolia-Application-Id' => $this->appId,
                'X-Algolia-API-Key' => $this->apiKey,
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
                $body = $response->json() ?? [];
                $error = $body['message'] ?? $response->body();

                Log::error("Algolia API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Algolia API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Algolia API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Algolia API: {$e->getMessage()}");
        }
    }
}
