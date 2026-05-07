<?php

namespace OpenCompany\Integrations\Chroma;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Chroma REST API.
 *
 * Uses the official v2 tenant/database endpoint shape, x-chroma-token
 * authentication, and normalized JSON error handling.
 */
class ChromaService
{
    /**
     * @param  string  $apiKey  Chroma API token.
     * @param  string  $baseUrl  Chroma server origin, without `/api/v2`.
     * @param  string  $tenant  Chroma tenant id or default tenant name.
     * @param  string  $database  Chroma database name.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'http://localhost:8000',
        private string $tenant = 'default_tenant',
        private string $database = 'default_database',
    ) {
        $this->baseUrl = rtrim($this->normalizeBaseUrl($this->baseUrl), '/');
    }

    /**
     * Check whether the service has an API token.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Check Chroma server heartbeat.
     *
     * @return array<string, mixed>
     */
    public function getHealth(): array
    {
        return $this->request('GET', '/api/v2/heartbeat');
    }

    /**
     * List collections in the configured tenant/database.
     *
     * @return array<string, mixed>|array<int, mixed>
     */
    public function listCollections(int $limit = 100, ?int $offset = null): array
    {
        $params = ['limit' => $limit];
        if ($offset !== null) {
            $params['offset'] = $offset;
        }

        return $this->request('GET', $this->databasePath('/collections'), $params);
    }

    /**
     * Count collections in the configured tenant/database.
     *
     * @return array<string, mixed>
     */
    public function countCollections(): array
    {
        return ['count' => $this->request('GET', $this->databasePath('/collections_count'))];
    }

    /**
     * Get a collection by UUID or name.
     *
     * @return array<string, mixed>
     */
    public function getCollection(string $collectionId): array
    {
        return $this->request('GET', $this->collectionPath($collectionId));
    }

    /**
     * Create a new collection.
     *
     * @param  array<string, mixed>|null  $metadata  Optional collection metadata.
     * @param  array<string, mixed>|null  $configuration  Optional index configuration.
     * @return array<string, mixed>
     */
    public function createCollection(string $name, ?array $metadata = null, ?array $configuration = null): array
    {
        $body = ['name' => $name];

        if ($metadata !== null) {
            $body['metadata'] = $metadata;
        }

        if ($configuration !== null) {
            $body['configuration'] = $configuration;
        }

        return $this->request('POST', $this->databasePath('/collections'), $body);
    }

    /**
     * Update collection name, metadata, or configuration.
     *
     * @param  array<string, mixed>|null  $metadata  Replacement metadata.
     * @param  array<string, mixed>|null  $configuration  Replacement configuration.
     * @return array<string, mixed>
     */
    public function updateCollection(string $collectionId, ?string $newName = null, ?array $metadata = null, ?array $configuration = null): array
    {
        $body = [];

        if ($newName !== null) {
            $body['new_name'] = $newName;
        }

        if ($metadata !== null) {
            $body['new_metadata'] = $metadata;
        }

        if ($configuration !== null) {
            $body['new_configuration'] = $configuration;
        }

        return $this->request('PUT', $this->collectionPath($collectionId), $body);
    }

    /**
     * Delete a collection and all records in it.
     *
     * @return array<string, mixed>
     */
    public function deleteCollection(string $collectionId): array
    {
        return $this->request('DELETE', $this->collectionPath($collectionId));
    }

    /**
     * Add records to a collection.
     *
     * @param  array<string, mixed>  $documents  Column-oriented record payload.
     * @return array<string, mixed>
     */
    public function addDocuments(string $collectionId, array $documents): array
    {
        return $this->request('POST', $this->collectionPath($collectionId, '/add'), $documents);
    }

    /**
     * Update existing records in a collection.
     *
     * @param  array<string, mixed>  $documents  Column-oriented record payload.
     * @return array<string, mixed>
     */
    public function updateDocuments(string $collectionId, array $documents): array
    {
        return $this->request('POST', $this->collectionPath($collectionId, '/update'), $documents);
    }

    /**
     * Upsert records in a collection.
     *
     * @param  array<string, mixed>  $documents  Column-oriented record payload.
     * @return array<string, mixed>
     */
    public function upsertDocuments(string $collectionId, array $documents): array
    {
        return $this->request('POST', $this->collectionPath($collectionId, '/upsert'), $documents);
    }

    /**
     * Delete records from a collection.
     *
     * @param  array<string, mixed>  $filters  Record ids or filter payload.
     * @return array<string, mixed>
     */
    public function deleteDocuments(string $collectionId, array $filters): array
    {
        return $this->request('POST', $this->collectionPath($collectionId, '/delete'), $filters);
    }

    /**
     * Count records in a collection.
     *
     * @return array<string, mixed>
     */
    public function countDocuments(string $collectionId): array
    {
        return ['count' => $this->request('GET', $this->collectionPath($collectionId, '/count'))];
    }

    /**
     * Query documents in a collection using embeddings, text, or filters.
     *
     * @param  array<string, mixed>  $query  Chroma query payload.
     * @return array<string, mixed>
     */
    public function queryDocuments(string $collectionId, array $query): array
    {
        return $this->request('POST', $this->collectionPath($collectionId, '/query'), $query);
    }

    /**
     * Get records from a collection by IDs and/or filters.
     *
     * @param  array<string, mixed>  $params  Chroma get payload.
     * @return array<string, mixed>
     */
    public function getDocument(string $collectionId, array $params): array
    {
        return $this->request('POST', $this->collectionPath($collectionId, '/get'), $params);
    }

    /**
     * Make an API request and return parsed JSON or scalar response.
     *
     * @param  array<string, mixed>  $data  Query params for GET or JSON body for mutating requests.
     * @return array<string, mixed>|array<int, mixed>|int
     */
    private function request(string $method, string $path, array $data = []): array|int
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Chroma API.
     *
     * @param  array<string, mixed>  $data  Query params for GET or JSON body for mutating requests.
     *
     * @throws \RuntimeException When credentials are missing or the API fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if ($this->apiKey === '') {
            throw new \RuntimeException('Chroma API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'x-chroma-token' => $this->apiKey,
                'Accept' => 'application/json',
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
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();
                Log::error("Chroma API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Chroma API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Chroma API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Chroma API: {$e->getMessage()}");
        }
    }

    /**
     * Build a database-scoped API path.
     */
    private function databasePath(string $suffix = ''): string
    {
        return '/api/v2/tenants/' . rawurlencode($this->tenant) . '/databases/' . rawurlencode($this->database) . $suffix;
    }

    /**
     * Build a collection-scoped API path.
     */
    private function collectionPath(string $collectionId, string $suffix = ''): string
    {
        return $this->databasePath('/collections/' . rawurlencode($collectionId) . $suffix);
    }

    /**
     * Accept legacy config values that already include `/api/v1` or `/api/v2`.
     */
    private function normalizeBaseUrl(string $baseUrl): string
    {
        return (string) preg_replace('#/api/v[12]$#', '', rtrim($baseUrl, '/'));
    }
}
