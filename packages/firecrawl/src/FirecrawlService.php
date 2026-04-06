<?php

namespace OpenCompany\Integrations\Firecrawl;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Firecrawl API service — handles authentication, HTTP communication,
 * and error handling for all Firecrawl v1 endpoints.
 *
 * Supports configurable base URL for self-hosted instances.
 */
class FirecrawlService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.firecrawl.dev/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has been configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Scrape a single URL and return its content.
     *
     * @param  string  $url  The URL to scrape.
     * @param  array  $options  Optional scrape options (formats, includeMarkdown, etc.).
     * @return array<string, mixed> The scrape result.
     */
    public function scrape(string $url, array $options = []): array
    {
        $body = array_merge(['url' => $url], $options);

        return $this->request('POST', '/scrape', $body);
    }

    /**
     * Start a crawl job for a URL. Returns the crawl job ID and status.
     *
     * @param  string  $url  The root URL to crawl.
     * @param  array  $options  Optional crawl options (limit, maxDepth, etc.).
     * @return array<string, mixed> The crawl job info including `id`.
     */
    public function crawl(string $url, array $options = []): array
    {
        $body = array_merge(['url' => $url], $options);

        return $this->request('POST', '/crawl', $body);
    }

    /**
     * Get the status and results of a crawl job.
     *
     * @param  string  $id  The crawl job ID.
     * @return array<string, mixed> The crawl status and any available data.
     */
    public function getCrawlStatus(string $id): array
    {
        return $this->request('GET', '/crawl/' . urlencode($id));
    }

    /**
     * Map a URL to discover all linked pages on the site.
     *
     * @param  string  $url  The root URL to map.
     * @param  array  $options  Optional map options (limit, includeSubdomains, etc.).
     * @return array<string, mixed> The map result including discovered URLs.
     */
    public function map(string $url, array $options = []): array
    {
        $body = array_merge(['url' => $url], $options);

        return $this->request('POST', '/map', $body);
    }

    /**
     * Extract structured data from one or more URLs using AI.
     *
     * @param  array<string>  $urls  The URLs to extract data from.
     * @param  array  $options  Optional extraction options (prompt, schema, etc.).
     * @return array<string, mixed> The extraction results.
     */
    public function extract(array $urls, array $options = []): array
    {
        $body = array_merge(['urls' => $urls], $options);

        return $this->request('POST', '/extract', $body);
    }

    /**
     * Get the currently authenticated user's information.
     *
     * @return array<string, mixed> User profile and account details.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (relative to base URL).
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return array<string, mixed> The decoded JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Firecrawl API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException When the API key is missing, the request fails, or the server returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Firecrawl API key is not configured.');
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
                    Log::warning("Firecrawl API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Firecrawl API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the base URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Firecrawl API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Firecrawl API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Firecrawl API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Firecrawl API: {$e->getMessage()}");
        }
    }
}
