<?php

namespace OpenCompany\Integrations\Pinecone;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Pinecone API service for managing vector indexes, upserting vectors, and querying embeddings.
 *
 * Handles authentication via Bearer token and communicates with the Pinecone REST API.
 * Supports configurable base URL for different Pinecone environments.
 */
class PineconeService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.pinecone.io',
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
     * @return array<string, mixed> The created index description.
     */
    public function createIndex(string $name, int $dimension, string $metric = 'cosine'): array
    {
        return $this->request('POST', '/indexes', [
            'name' => $name,
            'dimension' => $dimension,
            'metric' => $metric,
            'spec' => [
                'serverless' => [
                    'cloud' => 'aws',
                    'region' => 'us-east-1',
                ],
            ],
        ]);
    }

    /**
     * Upsert vectors into an index.
     *
     * @param  string  $indexHost  The index host URL (e.g., "idx-abc.svc.us-east-1.pinecone.io").
     * @param  array<int, array{id: string, values: float[], metadata?: array<string, mixed>}>  $vectors  The vectors to upsert.
     * @return array<string, mixed> The upsert response.
     */
    public function upsertVectors(string $indexHost, array $vectors): array
    {
        return $this->request('POST', '/vectors/upsert', [
            'vectors' => $vectors,
        ], $indexHost);
    }

    /**
     * Query an index for similar vectors.
     *
     * @param  string  $indexHost  The index host URL.
     * @param  float[]  $vector  The query vector embedding.
     * @param  int  $topK  Number of top results to return.
     * @param  array<string, mixed>|null  $filter  Metadata filter expression.
     * @param  bool  $includeMetadata  Whether to include metadata in results.
     * @return array<string, mixed> The query response with matches.
     */
    public function queryVectors(
        string $indexHost,
        array $vector,
        int $topK = 10,
        ?array $filter = null,
        bool $includeMetadata = true,
    ): array {
        $body = [
            'vector' => $vector,
            'top_k' => $topK,
            'include_metadata' => $includeMetadata,
        ];

        if ($filter !== null) {
            $body['filter'] = $filter;
        }

        return $this->request('POST', '/query', $body, $indexHost);
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
     * Get the current authenticated user.
     *
     * @return array<string, mixed> The user information.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
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
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
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
