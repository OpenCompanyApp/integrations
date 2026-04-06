<?php

namespace OpenCompany\Integrations\Elastic;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ElasticService
{
    private string $baseUrl;

    private ?string $apiKey = null;

    private ?string $username = null;

    private ?string $password = null;

    /**
     * @param  string  $baseUrl  Elasticsearch base URL (default: http://localhost:9200)
     * @param  string|null  $apiKey  API key for Bearer token authentication
     * @param  string|null  $username  Username for Basic authentication
     * @param  string|null  $password  Password for Basic authentication
     */
    public function __construct(
        string $baseUrl = 'http://localhost:9200',
        ?string $apiKey = null,
        ?string $username = null,
        ?string $password = null,
    ) {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->apiKey = $apiKey;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Check whether the service has enough credentials to make requests.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey) || (! empty($this->username) && ! empty($this->password));
    }

    /**
     * List all indices in the cluster.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listIndices(): array
    {
        return $this->request('GET', '/_cat/indices?format=json');
    }

    /**
     * Get detailed information about a specific index.
     *
     * @param  string  $name  The index name
     * @return array<string, mixed>
     */
    public function getIndex(string $name): array
    {
        return $this->request('GET', '/' . urlencode($name));
    }

    /**
     * Create a new index with optional settings and mappings.
     *
     * @param  string  $name  The index name
     * @param  array<string, mixed>|null  $settings  Optional index settings and mappings
     * @return array<string, mixed>
     */
    public function createIndex(string $name, ?array $settings = null): array
    {
        $body = $settings ?? [];

        return $this->request('PUT', '/' . urlencode($name), $body);
    }

    /**
     * Search for documents in an index.
     *
     * @param  string  $index  The index to search
     * @param  array<string, mixed>  $body  The search body (query, aggregations, etc.)
     * @return array<string, mixed>
     */
    public function searchDocuments(string $index, array $body = []): array
    {
        return $this->request('POST', '/' . urlencode($index) . '/_search', $body);
    }

    /**
     * Index (create or replace) a document.
     *
     * When $id is provided, uses PUT /{index}/_doc/{id} (explicit ID).
     * When $id is null, uses POST /{index}/_doc (auto-generated ID).
     *
     * @param  string  $index  The target index
     * @param  string|null  $id  Optional document ID
     * @param  array<string, mixed>  $body  The document body
     * @return array<string, mixed>
     */
    public function indexDocument(string $index, ?string $id, array $body): array
    {
        if ($id !== null && $id !== '') {
            return $this->request('PUT', '/' . urlencode($index) . '/_doc/' . urlencode($id), $body);
        }

        return $this->request('POST', '/' . urlencode($index) . '/_doc', $body);
    }

    /**
     * Get a single document by ID.
     *
     * @param  string  $index  The index name
     * @param  string  $id  The document ID
     * @return array<string, mixed>
     */
    public function getDocument(string $index, string $id): array
    {
        return $this->request('GET', '/' . urlencode($index) . '/_doc/' . urlencode($id));
    }

    /**
     * Get the cluster health status.
     *
     * @return array<string, mixed>
     */
    public function clusterHealth(): array
    {
        return $this->request('GET', '/_cluster/health');
    }

    /**
     * Make an authenticated API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API path (appended to base URL)
     * @param  array<string, mixed>  $data  Request body or query parameters
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Elasticsearch API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API path (appended to base URL)
     * @param  array<string, mixed>  $data  Request body or query parameters
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On connection failure or API error
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Elasticsearch is not configured. Provide an API key or username/password.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(30);

            // Use Bearer auth with API key, or Basic auth with username/password
            if (! empty($this->apiKey)) {
                $http = $http->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                ]);
            } else {
                $http = $http->withBasicAuth($this->username, $this->password);
            }

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $error = $response->json('error.reason') ?? $response->json('error') ?? $response->body();
                Log::error("Elasticsearch API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Elasticsearch API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Elasticsearch connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Elasticsearch: {$e->getMessage()}");
        }
    }
}
