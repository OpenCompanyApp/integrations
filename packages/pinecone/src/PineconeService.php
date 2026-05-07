<?php

namespace OpenCompany\Integrations\Pinecone;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Pinecone API service for managing vector indexes, upserting vectors, and querying embeddings.
 *
 * Handles API key authentication and communicates with the Pinecone REST API.
 * Supports configurable base URL for different Pinecone environments.
 */
class PineconeService
{
    /**
     * @param  string  $accessToken  Pinecone API key.
     * @param  string  $baseUrl  Pinecone control-plane API base URL.
     * @param  string  $apiVersion  Date-based Pinecone API version.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.pinecone.io',
        private string $apiVersion = '2026-04',
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
     * List all indexes in the Pinecone project.
     *
     * @return array<string, mixed> The API response containing index descriptions.
     */
    public function listIndexes(): array
    {
        return $this->request('GET', '/indexes');
    }

    /**
     * Get a specific index by name.
     *
     * @param  string  $name  The index name.
     * @return array<string, mixed> The index description.
     */
    public function getIndex(string $name): array
    {
        return $this->request('GET', '/indexes/' . urlencode($name));
    }

    /**
     * Create a new serverless index.
     *
     * @param  string  $name  The index name.
     * @param  int  $dimension  The dimension size for vectors.
     * @param  string  $metric  The similarity metric (cosine, euclidean, dotproduct).
     * @param  string  $cloud  Serverless cloud provider.
     * @param  string  $region  Serverless cloud region.
     * @return array<string, mixed> The created index description.
     */
    public function createIndex(string $name, int $dimension, string $metric = 'cosine', string $cloud = 'aws', string $region = 'us-east-1'): array
    {
        return $this->request('POST', '/indexes', [
            'name' => $name,
            'dimension' => $dimension,
            'metric' => $metric,
            'spec' => [
                'serverless' => [
                    'cloud' => $cloud,
                    'region' => $region,
                ],
            ],
        ]);
    }

    /**
     * Configure an existing index.
     *
     * @param  string  $name  The index name.
     * @param  array<string, mixed>  $config  Index configuration body.
     * @return array<string, mixed> The updated index description.
     */
    public function configureIndex(string $name, array $config): array
    {
        return $this->request('PATCH', '/indexes/' . urlencode($name), $config);
    }

    /**
     * Delete an index.
     *
     * @param  string  $name  The index name.
     * @return array<string, mixed>
     */
    public function deleteIndex(string $name): array
    {
        return $this->request('DELETE', '/indexes/' . urlencode($name));
    }

    /**
     * Upsert vectors into an index.
     *
     * @param  string  $indexHost  The index host URL (e.g., "idx-abc.svc.us-east-1.pinecone.io").
     * @param  array<int, array{id: string, values: float[], metadata?: array<string, mixed>}>  $vectors  The vectors to upsert.
     * @param  string|null  $namespace  Optional namespace.
     * @return array<string, mixed> The upsert response.
     */
    public function upsertVectors(string $indexHost, array $vectors, ?string $namespace = null): array
    {
        $body = [
            'vectors' => $vectors,
        ];

        if ($namespace !== null && $namespace !== '') {
            $body['namespace'] = $namespace;
        }

        return $this->request('POST', '/vectors/upsert', $body, $indexHost);
    }

    /**
     * Query an index for similar vectors.
     *
     * @param  string  $indexHost  The index host URL.
     * @param  float[]  $vector  The query vector embedding.
     * @param  int  $topK  Number of top results to return.
     * @param  array<string, mixed>|null  $filter  Metadata filter expression.
     * @param  bool  $includeMetadata  Whether to include metadata in results.
     * @param  bool  $includeValues  Whether to include vector values in results.
     * @param  string|null  $namespace  Optional namespace.
     * @return array<string, mixed> The query response with matches.
     */
    public function queryVectors(
        string $indexHost,
        array $vector,
        int $topK = 10,
        ?array $filter = null,
        bool $includeMetadata = true,
        bool $includeValues = false,
        ?string $namespace = null,
    ): array {
        $body = [
            'vector' => $vector,
            'top_k' => $topK,
            'include_metadata' => $includeMetadata,
            'include_values' => $includeValues,
        ];

        if ($filter !== null) {
            $body['filter'] = $filter;
        }
        if ($namespace !== null && $namespace !== '') {
            $body['namespace'] = $namespace;
        }

        return $this->request('POST', '/query', $body, $indexHost);
    }

    /**
     * Fetch vectors by ID from an index.
     *
     * @param  string  $indexHost  The index host URL.
     * @param  array<int, string>  $ids  Vector IDs to fetch.
     * @param  string|null  $namespace  Optional namespace.
     * @return array<string, mixed> The fetched vectors.
     */
    public function fetchVectors(string $indexHost, array $ids, ?string $namespace = null): array
    {
        $query = [];

        foreach ($ids as $id) {
            $query[] = 'ids=' . rawurlencode((string) $id);
        }

        if ($namespace !== null && $namespace !== '') {
            $query[] = 'namespace=' . rawurlencode($namespace);
        }

        return $this->request('GET', '/vectors/fetch?' . implode('&', $query), [], $indexHost);
    }

    /**
     * Update vector values or metadata.
     *
     * @param  string  $indexHost  The index host URL.
     * @param  array<string, mixed>  $payload  Update request body.
     * @return array<string, mixed> The update response.
     */
    public function updateVector(string $indexHost, array $payload): array
    {
        return $this->request('POST', '/vectors/update', $payload, $indexHost);
    }

    /**
     * Delete vectors by IDs, filter, or all records in a namespace.
     *
     * @param  string  $indexHost  The index host URL.
     * @param  array<string, mixed>  $payload  Delete request body.
     * @return array<string, mixed> The delete response.
     */
    public function deleteVectors(string $indexHost, array $payload): array
    {
        return $this->request('POST', '/vectors/delete', $payload, $indexHost);
    }

    /**
     * Describe index statistics.
     *
     * @param  string  $indexHost  The index host URL.
     * @param  array<string, mixed>|null  $filter  Optional metadata filter.
     * @return array<string, mixed> Index statistics.
     */
    public function describeIndexStats(string $indexHost, ?array $filter = null): array
    {
        return $this->request('POST', '/describe_index_stats', $filter !== null ? ['filter' => $filter] : [], $indexHost);
    }

    /**
     * List all collections in the Pinecone project.
     *
     * @return array<string, mixed> The API response containing collections.
     */
    public function listCollections(): array
    {
        return $this->request('GET', '/collections');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @param  string|null  $overrideHost  Optional override host URL (for index-specific operations).
     * @return array<string, mixed> The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = [], ?string $overrideHost = null): array
    {
        $response = $this->rawRequest($method, $path, $data, $overrideHost);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Pinecone API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @param  string|null  $overrideHost  Optional override host URL for index-specific endpoints.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException On connection failure or API error.
     */
    private function rawRequest(string $method, string $path, array $data = [], ?string $overrideHost = null): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Pinecone access token is not configured.');
        }

        $baseUrl = $overrideHost ? rtrim($overrideHost, '/') : $this->baseUrl;
        $url = $baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Api-Key' => $this->accessToken,
                'X-Pinecone-Api-Version' => $this->apiVersion,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $data === [] ? $http->get($url) : $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PATCH' => $http->patch($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = (string) $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Pinecone API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Pinecone API endpoint not available (HTTP {$response->status()}). Check the base URL and access token.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Pinecone API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Pinecone API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Pinecone API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Pinecone API: {$e->getMessage()}");
        }
    }
}
