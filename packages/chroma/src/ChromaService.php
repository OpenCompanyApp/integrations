<?php

namespace OpenCompany\Integrations\Chroma;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChromaService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'http://localhost:8000/api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Check Chroma server health.
     */
    public function getHealth(): array
    {
        return $this->request('GET', '/api/v1/heartbeat');
    }

    /**
     * List all collections.
     */
    public function listCollections(int $limit = 100, ?string $after = null): array
    {
        $params = ['limit' => $limit];
        if ($after) {
            $params['after'] = $after;
        }

        return $this->request('GET', '/collections', $params);
    }

    /**
     * Get a collection by name or ID.
     */
    public function getCollection(string $collectionId): array
    {
        return $this->request('GET', '/collections/' . urlencode($collectionId));
    }

    /**
     * Create a new collection.
     */
    public function createCollection(string $name, ?string $description = null, ?array $metadata = null): array
    {
        $body = ['name' => $name];

        if ($description !== null) {
            $body['description'] = $description;
        }

        if ($metadata !== null) {
            $body['metadata'] = $metadata;
        }

        return $this->request('POST', '/collections', $body);
    }

    /**
     * Add documents (with embeddings) to a collection.
     */
    public function addDocuments(string $collectionId, array $documents): array
    {
        return $this->request('POST', '/collections/' . urlencode($collectionId) . '/add', $documents);
    }

    /**
     * Query documents in a collection using embeddings.
     */
    public function queryDocuments(string $collectionId, array $query): array
    {
        return $this->request('POST', '/collections/' . urlencode($collectionId) . '/query', $query);
    }

    /**
     * Get a single document by ID from a collection.
     */
    public function getDocument(string $collectionId, array $params): array
    {
        return $this->request('POST', '/collections/' . urlencode($collectionId) . '/get', $params);
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
     * Make a raw HTTP request to the Chroma API.
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
}
