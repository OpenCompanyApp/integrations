<?php

namespace OpenCompany\Integrations\Exa;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Exa AI search API.
 *
 * Wraps all Exa endpoints (search, findSimilar, contents, user) behind
 * typed methods. Tools call this service — they never make HTTP requests directly.
 */
class ExaService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.exa.ai',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the API key has been configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    // ── Search ────────────────────────────────────────────

    /**
     * Perform a neural search query.
     *
     * @param  array<string, mixed>  $body  Request payload (query, num_results, etc.)
     * @return array<string, mixed>
     */
    public function search(array $body): array
    {
        return $this->request('POST', '/search', $body);
    }

    /**
     * Find pages similar to a given URL.
     *
     * @param  array<string, mixed>  $body  Request payload (url, num_results, etc.)
     * @return array<string, mixed>
     */
    public function findSimilar(array $body): array
    {
        return $this->request('POST', '/findSimilar', $body);
    }

    /**
     * Retrieve contents for a list of document IDs.
     *
     * @param  array<string, mixed>  $body  Request payload (ids, text, highlights, etc.)
     * @return array<string, mixed>
     */
    public function getContents(array $body): array
    {
        return $this->request('POST', '/contents', $body);
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    // ── HTTP ──────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path    API endpoint path
     * @param  array<string, mixed>  $data  Query params or JSON body
     * @return array<string, mixed>
     *
     * @throws \RuntimeException on connection or API errors
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Exa API.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path    API endpoint path
     * @param  array<string, mixed>  $data  Request data
     *
     * @throws \RuntimeException on missing credentials, connection errors, or API errors
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('Exa API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'x-api-key' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $error = $response->json('error') ?? $response->body();

                Log::error("Exa API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException(
                    'Exa API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Exa API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Exa API: {$e->getMessage()}");
        }
    }
}
