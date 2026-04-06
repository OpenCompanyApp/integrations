<?php

namespace OpenCompany\Integrations\Qdrant;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class QdrantService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://your-cluster-url.qdrant.tech:6333',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has an API key configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List all collections in the Qdrant cluster.
     *
     * @return array<string, mixed>
     */
    public function listCollections(): array
    {
        return $this->request('GET', '/collections');
    }

    /**
     * Get detailed information about a specific collection.
     *
     * @return array<string, mixed>
     */
    public function getCollection(string $name): array
    {
        return $this->request('GET', '/collections/' . urlencode($name));
    }

    /**
     * Create a new collection with the given vector configuration.
     *
     * @param  array<string, mixed>  $config  Collection creation payload (vectors, hnsw_config, etc.).
     * @return array<string, mixed>
     */
    public function createCollection(string $name, array $config = []): array
    {
        return $this->request('PUT', '/collections/' . urlencode($name), $config);
    }

    /**
     * Search for points in a collection using a vector or filter.
     *
     * @param  array<string, mixed>  $body  Search payload (vector, filter, limit, with_payload, etc.).
     * @return array<string, mixed>
     */
    public function search(string $collection, array $body): array
    {
        return $this->request('POST', '/collections/' . urlencode($collection) . '/points/search', $body);
    }

    /**
     * Upsert (insert or update) points into a collection.
     *
     * @param  array<string, mixed>  $body  Upsert payload containing a "points" array.
     * @return array<string, mixed>
     */
    public function upsertPoints(string $collection, array $body): array
    {
        return $this->request('PUT', '/collections/' . urlencode($collection) . '/points', $body);
    }

    /**
     * Get information about the current Qdrant cluster and authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/cluster');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Qdrant REST API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Qdrant API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'api-key' => $this->apiKey,
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

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Qdrant API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Qdrant API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('status') ?? $response->json('error') ?? $body;
                Log::error("Qdrant API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Qdrant API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Qdrant API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Qdrant API: {$e->getMessage()}");
        }
    }
}
