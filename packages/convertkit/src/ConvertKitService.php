<?php

namespace OpenCompany\Integrations\ConvertKit;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the current Kit API.
 *
 * Handles V4 API key or OAuth bearer authentication, response parsing, and
 * safe relative endpoint access for all ConvertKit tools.
 */
class ConvertKitService
{
    /**
     * @param  string  $apiKey  Kit V4 API key for personal account automation.
     * @param  string  $baseUrl  Base URL for the Kit API.
     * @param  string  $accessToken  OAuth access token for endpoints that require OAuth.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.kit.com',
        private string $accessToken = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has either API key or OAuth credentials.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== '' || $this->accessToken !== '';
    }

    /**
     * Get the authenticated Kit account.
     *
     * @return array<string, mixed>
     */
    public function getCurrentAccount(): array
    {
        return $this->apiGet('/account');
    }

    /**
     * Backwards-compatible alias for existing callers.
     *
     * @return array<string, mixed>
     */
    public function getAccount(): array
    {
        return $this->getCurrentAccount();
    }

    /**
     * Execute a GET request against a safe relative Kit API path.
     *
     * @param  string  $path  Relative path, for example /subscribers.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, $query);
    }

    /**
     * Execute a POST request against a safe relative Kit API path.
     *
     * @param  string  $path  Relative path, for example /subscribers.
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = [], array $query = []): array
    {
        return $this->request('POST', $path, $query, $body);
    }

    /**
     * Execute a PUT request against a safe relative Kit API path.
     *
     * @param  string  $path  Relative path, for example /subscribers/123.
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $body = [], array $query = []): array
    {
        return $this->request('PUT', $path, $query, $body);
    }

    /**
     * Execute a DELETE request against a safe relative Kit API path.
     *
     * @param  string  $path  Relative path, for example /tags/123/subscribers/456.
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $body = [], array $query = []): array
    {
        return $this->request('DELETE', $path, $query, $body);
    }

    /**
     * Execute an authenticated request and parse the JSON response.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Safe relative endpoint path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        if ($response->status() === 204 || trim($response->body()) === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        return $response->json() ?? [];
    }

    /**
     * Execute an authenticated raw HTTP request.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Safe relative endpoint path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if (!$this->isConfigured()) {
            throw new \RuntimeException('ConvertKit integration is not configured.');
        }

        $url = $this->url($this->safePath($path), $query);

        try {
            $headers = [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ];

            if ($this->accessToken !== '') {
                $headers['Authorization'] = 'Bearer ' . $this->accessToken;
            } else {
                $headers['X-Kit-Api-Key'] = $this->apiKey;
            }

            $http = Http::withHeaders($headers)->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'DELETE' => $http->delete($url, $body),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("ConvertKit API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Kit API: {$e->getMessage()}");
        }
    }

    /**
     * Convert a caller path into a safe V4 relative path.
     */
    private function safePath(string $path): string
    {
        $path = trim($path);

        if ($path === '' || preg_match('#^[a-z][a-z0-9+.-]*://#i', $path) || str_starts_with($path, '//') || str_contains($path, '..')) {
            throw new \InvalidArgumentException('Path must be a safe relative Kit API path.');
        }

        $path = '/' . ltrim($path, '/');

        if (!str_starts_with($path, '/v4/')) {
            $path = '/v4' . $path;
        }

        return $path;
    }

    /**
     * Build the absolute request URL.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function url(string $path, array $query = []): string
    {
        $query = array_filter($query, static fn (mixed $value): bool => $value !== null && $value !== '');

        if ($query === []) {
            return $this->baseUrl . $path;
        }

        return $this->baseUrl . $path . '?' . http_build_query($query);
    }

    /**
     * Parse and throw a normalized API error.
     *
     * @throws \RuntimeException
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $contentType = $response->header('Content-Type') ?? '';
        $body = $response->body();

        if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
            Log::warning("ConvertKit API returned HTML for {$method} {$path}", [
                'status' => $response->status(),
            ]);

            throw new \RuntimeException("Kit API returned unexpected HTML (HTTP {$response->status()}).");
        }

        $errors = $response->json('errors');
        $error = is_array($errors)
            ? implode('; ', array_map(static fn (mixed $item): string => is_scalar($item) ? (string) $item : json_encode($item), $errors))
            : ($response->json('error') ?? $response->json('message') ?? $body);

        Log::error("ConvertKit API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new \RuntimeException("Kit API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }
}
