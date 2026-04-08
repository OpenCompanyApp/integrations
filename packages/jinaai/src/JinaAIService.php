<?php

namespace OpenCompany\Integrations\JinaAI;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * JinaAIService — HTTP client for the Jina AI API.
 *
 * Wraps all Jina AI v1 endpoints: search, read, ground, embeddings, and rerank.
 * Each method accepts an array payload matching the upstream API and returns
 * the parsed JSON response.
 *
 * @see https://jina.ai/api/
 */
class JinaAIService
{
    /**
     * Create a new JinaAIService instance.
     *
     * @param  string  $apiKey  Jina AI API key
     * @param  string  $baseUrl Base URL for the Jina AI API (default: https://api.jina.ai/v1)
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.jina.ai/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Determine whether the service is configured (API key is present).
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Search the web using Jina AI Search.
     *
     * @param  array  $body  Request payload (must contain 'q')
     * @return array<string, mixed> Parsed JSON response
     *
     * @see https://jina.ai/api/#search
     */
    public function search(array $body): array
    {
        return $this->request('POST', '/search', $body);
    }

    /**
     * Read and extract content from a URL using Jina AI Reader.
     *
     * @param  array  $body  Request payload (must contain 'url')
     * @return array<string, mixed> Parsed JSON response
     *
     * @see https://jina.ai/api/#reader
     */
    public function read(array $body): array
    {
        return $this->request('POST', '/read', $body);
    }

    /**
     * Ground a statement against provided context using Jina AI Grounding.
     *
     * @param  array  $body  Request payload (must contain 'statement' and 'context')
     * @return array<string, mixed> Parsed JSON response
     *
     * @see https://jina.ai/api/#grounding
     */
    public function ground(array $body): array
    {
        return $this->request('POST', '/ground', $body);
    }

    /**
     * Generate embeddings for the given input using Jina AI Embeddings.
     *
     * @param  array  $body  Request payload (must contain 'input')
     * @return array<string, mixed> Parsed JSON response
     *
     * @see https://jina.ai/api/#embeddings
     */
    public function embeddings(array $body): array
    {
        return $this->request('POST', '/embeddings', $body);
    }

    /**
     * Rerank documents against a query using Jina AI Reranker.
     *
     * @param  array  $body  Request payload (must contain 'query' and 'documents')
     * @return array<string, mixed> Parsed JSON response
     *
     * @see https://jina.ai/api/#reranker
     */
    public function rerank(array $body): array
    {
        return $this->request('POST', '/rerank', $body);
    }

    /**
     * Make an API request and return the parsed JSON body.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path    API path (e.g. /search)
     * @param  array<string, mixed>  $data  Request payload
     * @return array<string, mixed> Parsed JSON response
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Jina AI API.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path    API path
     * @param  array<string, mixed>  $data  Request payload
     * @return \Illuminate\Http\Client\Response Raw HTTP response
     *
     * @throws \RuntimeException When the API key is missing or the request fails
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Jina AI API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(60);

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
                    Log::warning("Jina AI API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Jina AI API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable.");
                }

                $error = $response->json('error') ?? $response->json('detail') ?? $body;
                Log::error("Jina AI API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Jina AI API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Jina AI API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Jina AI API: {$e->getMessage()}");
        }
    }
}
