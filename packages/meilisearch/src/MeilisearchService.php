<?php

namespace OpenCompany\Integrations\Meilisearch;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MeilisearchService
{
    /**
     * Create a new MeilisearchService instance.
     *
     * @param  string  $apiKey  The Meilisearch API key (Bearer token).
     * @param  string  $baseUrl  The Meilisearch instance base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'http://localhost:7700',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Get the configured base URL.
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * List all indexes in the Meilisearch instance.
     *
     * @return array<string, mixed> The list of indexes.
     */
    public function listIndexes(): array
    {
        return $this->request('GET', '/indexes');
    }

    /**
     * Get detailed information about a specific index.
     *
     * @param  string  $uid  The index unique identifier.
     * @return array<string, mixed> The index information.
     */
    public function getIndex(string $uid): array
    {
        return $this->request('GET', '/indexes/' . urlencode($uid));
    }

    /**
     * Create a new index in Meilisearch.
     *
     * @param  string  $uid  The index unique identifier.
     * @param  string|null  $primaryKey  The primary key field for the index.
     * @return array<string, mixed> The task information.
     */
    public function createIndex(string $uid, ?string $primaryKey = null): array
    {
        $body = ['uid' => $uid];
        if ($primaryKey !== null) {
            $body['primaryKey'] = $primaryKey;
        }

        return $this->request('POST', '/indexes', $body);
    }

    /**
     * Search for documents in an index.
     *
     * @param  string  $indexUid  The index unique identifier.
     * @param  array<string, mixed>  $params  Search parameters (q, limit, offset, filter, sort, etc.).
     * @return array<string, mixed> The search results.
     */
    public function searchDocuments(string $indexUid, array $params): array
    {
        return $this->request('POST', '/indexes/' . urlencode($indexUid) . '/search', $params);
    }

    /**
     * Add or replace documents in an index.
     *
     * @param  string  $indexUid  The index unique identifier.
     * @param  array<int, array<string, mixed>>  $documents  The documents to add.
     * @param  string|null  $primaryKey  The primary key field (optional).
     * @return array<string, mixed> The task information.
     */
    public function addDocuments(string $indexUid, array $documents, ?string $primaryKey = null): array
    {
        $path = '/indexes/' . urlencode($indexUid) . '/documents';
        if ($primaryKey !== null) {
            $path .= '?primaryKey=' . urlencode($primaryKey);
        }

        return $this->request('POST', $path, $documents);
    }

    /**
     * Get a single document from an index.
     *
     * @param  string  $indexUid  The index unique identifier.
     * @param  string  $docId  The document primary key value.
     * @return array<string, mixed> The document data.
     */
    public function getDocument(string $indexUid, string $docId): array
    {
        return $this->request('GET', '/indexes/' . urlencode($indexUid) . '/documents/' . urlencode($docId));
    }

    /**
     * Get the health status of the Meilisearch instance.
     *
     * @return array<string, mixed> The health status.
     */
    public function getHealth(): array
    {
        return $this->request('GET', '/health');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  The API endpoint path.
     * @param  array<int|string, mixed>  $data  Request body or query parameters.
     * @return array<string, mixed> The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Meilisearch API.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  The API endpoint path.
     * @param  array<int|string, mixed>  $data  Request body or query parameters.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the request fails or the service is not configured.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Meilisearch API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
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
                $body = $response->body();
                $error = $response->json('message') ?? $response->json('error') ?? $body;

                Log::error("Meilisearch API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Meilisearch API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Meilisearch API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Meilisearch API: {$e->getMessage()}");
        }
    }
}
