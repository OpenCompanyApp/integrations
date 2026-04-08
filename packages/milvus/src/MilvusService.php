<?php

namespace OpenCompany\Integrations\Milvus;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MilvusService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.milvus.io/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Check Milvus server health.
     */
    public function getHealth(): array
    {
        return $this->request('GET', '/health');
    }

    /**
     * List all collections.
     */
    public function listCollections(int $limit = 100, int $offset = 0): array
    {
        return $this->request('GET', '/collections', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get a collection by name.
     */
    public function getCollection(string $collectionName): array
    {
        return $this->request('GET', '/collections/' . urlencode($collectionName));
    }

    /**
     * Create a new collection.
     */
    public function createCollection(string $name, int $dimension, ?string $description = null, ?array $params = null): array
    {
        $body = [
            'collectionName' => $name,
            'dimension' => $dimension,
        ];

        if ($description !== null) {
            $body['description'] = $description;
        }

        if ($params !== null) {
            $body['params'] = $params;
        }

        return $this->request('POST', '/collections', $body);
    }

    /**
     * Insert documents (vectors) into a collection.
     */
    public function insertDocuments(string $collectionName, array $data): array
    {
        return $this->request('POST', '/collections/' . urlencode($collectionName) . '/insert', $data);
    }

    /**
     * Search for similar documents in a collection.
     */
    public function searchDocuments(string $collectionName, array $query): array
    {
        return $this->request('POST', '/collections/' . urlencode($collectionName) . '/search', $query);
    }

    /**
     * Get statistics for a collection.
     */
    public function getCollectionStats(string $collectionName): array
    {
        return $this->request('GET', '/collections/' . urlencode($collectionName) . '/stats');
    }

    /**
     * Make an API request and return parsed JSON.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Milvus API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
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
                $error = $response->json('error') ?? $response->body();
                Log::error("Milvus API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Milvus API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Milvus API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Milvus API: {$e->getMessage()}");
        }
    }
}
