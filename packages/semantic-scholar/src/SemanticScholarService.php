<?php

namespace OpenCompany\Integrations\SemanticScholar;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for Semantic Scholar APIs.
 *
 * Handles Academic Graph, Recommendations, and Datasets API hosts with API-key
 * authentication, query normalization, JSON parsing, and error conversion.
 */
class SemanticScholarService
{
    /**
     * @param  string  $apiKey  Semantic Scholar API key.
     * @param  string  $graphUrl  Academic Graph API base URL.
     * @param  string  $recommendationsUrl  Recommendations API base URL.
     * @param  string  $datasetsUrl  Datasets API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $graphUrl = 'https://api.semanticscholar.org/graph/v1',
        private string $recommendationsUrl = 'https://api.semanticscholar.org/recommendations/v1',
        private string $datasetsUrl = 'https://api.semanticscholar.org/datasets/v1',
    ) {
        $this->graphUrl = rtrim($this->graphUrl, '/');
        $this->recommendationsUrl = rtrim($this->recommendationsUrl, '/');
        $this->datasetsUrl = rtrim($this->datasetsUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Make a GET request to the Academic Graph API.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function graphGet(string $path, array $query = []): array
    {
        return $this->request('GET', $this->graphUrl.'/'.ltrim($path, '/'), $query);
    }

    /**
     * Make a POST request to the Academic Graph API.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    public function graphPost(string $path, array $query = [], array $body = []): array
    {
        return $this->request('POST', $this->graphUrl.'/'.ltrim($path, '/'), $query, $body);
    }

    /**
     * Make a GET request to the Recommendations API.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function recommendationsGet(string $path, array $query = []): array
    {
        return $this->request('GET', $this->recommendationsUrl.'/'.ltrim($path, '/'), $query);
    }

    /**
     * Make a POST request to the Recommendations API.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    public function recommendationsPost(string $path, array $query = [], array $body = []): array
    {
        return $this->request('POST', $this->recommendationsUrl.'/'.ltrim($path, '/'), $query, $body);
    }

    /**
     * Make a GET request to the Datasets API.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function datasetsGet(string $path = '', array $query = []): array
    {
        return $this->request('GET', $this->datasetsUrl.'/'.ltrim($path, '/'), $query);
    }

    /**
     * Make an authenticated Semantic Scholar request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON body for POST requests.
     * @return array<string, mixed>
     */
    private function request(string $method, string $url, array $query = [], array $body = []): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Semantic Scholar API key is not configured.');
        }

        $query = $this->normalizeQuery($query);

        try {
            $client = Http::acceptJson()
                ->withHeaders(['x-api-key' => $this->apiKey])
                ->withUserAgent('OpenCompany Integrations semantic-scholar/1.0')
                ->timeout(60);

            $response = $method === 'POST'
                ? $client->post($this->urlWithQuery($url, $query), $body)
                : $client->get($this->urlWithQuery($url, $query));

            return $this->parseResponse($response, $method, $url);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Semantic Scholar API connection error: {$method} {$url}", ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to Semantic Scholar API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize query arrays to comma-separated values.
     *
     * @param  array<string, mixed>  $query  Raw query parameters.
     * @return array<string, scalar>
     */
    private function normalizeQuery(array $query): array
    {
        $normalized = [];
        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            if (is_array($value)) {
                $value = implode(',', array_map(static fn (mixed $item): string => (string) $item, array_filter($value, static fn (mixed $item): bool => $item !== null && $item !== '')));
            }

            if ($value !== '') {
                $normalized[$key] = is_bool($value) ? ($value ? 'true' : 'false') : $value;
            }
        }

        return $normalized;
    }

    /**
     * Append query parameters to a URL using Semantic Scholar's comma-list style.
     *
     * @param  array<string, scalar>  $query  Query parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        if ($query === []) {
            return $url;
        }

        return $url.'?'.http_build_query($query, '', '&', PHP_QUERY_RFC3986);
    }

    /**
     * Parse JSON responses and convert API errors to exceptions.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $method, string $url): array
    {
        $json = $response->json();
        if (!$response->successful()) {
            $message = is_array($json) ? ($json['message'] ?? $json['error'] ?? null) : null;
            $error = is_string($message) ? $message : $response->body();
            Log::error("Semantic Scholar API error: {$method} {$url}", ['status' => $response->status(), 'error' => $error]);

            throw new RuntimeException('Semantic Scholar API error ('.$response->status().'): '.$error);
        }

        return is_array($json) ? $json : ['body' => $response->body(), 'status' => $response->status()];
    }
}
