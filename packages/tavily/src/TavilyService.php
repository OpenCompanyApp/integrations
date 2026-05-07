<?php

namespace OpenCompany\Integrations\Tavily;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Tavily API.
 *
 * Handles bearer authentication, optional project scoping, error reporting,
 * and JSON response parsing for every Tavily endpoint exposed as a tool.
 */
class TavilyService
{
    /**
     * @param  string  $apiKey  Tavily API key.
     * @param  string  $baseUrl  Tavily API base URL.
     * @param  string  $projectId  Optional Tavily project ID for usage tracking.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.tavily.com',
        private string $projectId = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Execute a Tavily Search request.
     *
     * @param  array<string, mixed>  $params  Search request body.
     * @return array<string, mixed>
     */
    public function search(array $params): array
    {
        return $this->request('POST', '/search', $params);
    }

    /**
     * Extract content from one or more URLs.
     *
     * @param  array<string, mixed>  $params  Extract request body.
     * @return array<string, mixed>
     */
    public function extract(array $params): array
    {
        return $this->request('POST', '/extract', $params);
    }

    /**
     * Crawl a website and extract content from discovered pages.
     *
     * @param  array<string, mixed>  $params  Crawl request body.
     * @return array<string, mixed>
     */
    public function crawl(array $params): array
    {
        return $this->request('POST', '/crawl', $params, timeout: (int) ($params['timeout'] ?? 150));
    }

    /**
     * Map a website and return discovered URLs.
     *
     * @param  array<string, mixed>  $params  Map request body.
     * @return array<string, mixed>
     */
    public function map(array $params): array
    {
        return $this->request('POST', '/map', $params, timeout: (int) ($params['timeout'] ?? 150));
    }

    /**
     * Create an asynchronous Tavily Research task.
     *
     * @param  array<string, mixed>  $params  Research request body.
     * @return array<string, mixed>
     */
    public function createResearch(array $params): array
    {
        return $this->request('POST', '/research', $params);
    }

    /**
     * Retrieve a Tavily Research task by request ID.
     *
     * @return array<string, mixed>
     */
    public function getResearch(string $requestId): array
    {
        return $this->request('GET', '/research/' . rawurlencode($requestId));
    }

    /**
     * Get API key and account usage details.
     *
     * @return array<string, mixed>
     */
    public function usage(): array
    {
        return $this->request('GET', '/usage');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Request query string or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], int $timeout = 60): array
    {
        $response = $this->rawRequest($method, $path, $data, $timeout);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Tavily API.
     *
     * @param  array<string, mixed>  $data  Request query string or JSON body.
     */
    private function rawRequest(string $method, string $path, array $data = [], int $timeout = 60): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Tavily API key is not configured.');
        }

        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];

        if ($this->projectId !== '') {
            $headers['X-Project-ID'] = $this->projectId;
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders($headers)->timeout($timeout);
            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('error')
                    ?? $response->json('detail')
                    ?? $response->json('message')
                    ?? $response->body();

                Log::error("Tavily API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException("Tavily API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Tavily API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Tavily API: {$e->getMessage()}");
        }
    }
}
