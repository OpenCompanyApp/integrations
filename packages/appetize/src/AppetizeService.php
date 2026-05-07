<?php

namespace OpenCompany\Integrations\Appetize;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Appetize REST API.
 *
 * Handles X-API-KEY authentication, v1 and v2 endpoint paths, JSON response
 * parsing, and normalized API errors.
 */
class AppetizeService
{
    /**
     * @param  string  $apiKey  Appetize API token.
     * @param  string  $baseUrl  Appetize API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.appetize.io',
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: 'https://api.appetize.io', '/');
    }

    /**
     * Check whether the service has credentials configured.
     */
    public function isConfigured(): bool
    {
        return trim($this->apiKey) !== '' && trim($this->baseUrl) !== '';
    }

    /**
     * List apps with pagination.
     *
     * @param  array<string, mixed>  $query  Pagination query values such as nextKey.
     * @return array<string, mixed>
     */
    public function listApps(array $query = []): array { return $this->request('GET', '/v1/apps', $query); }

    /**
     * List all apps without pagination.
     *
     * @return array<string, mixed>
     */
    public function listAllApps(): array { return $this->request('GET', '/v1/apps/all'); }

    /**
     * Get one app or app group by public key.
     *
     * @param  string  $publicKey  App or app group public key.
     * @return array<string, mixed>
     */
    public function getApp(string $publicKey): array { return $this->request('GET', '/v1/apps/'.$this->segment($publicKey)); }

    /**
     * Create a new app from a public URL.
     *
     * @param  array<string, mixed>  $payload  App creation payload.
     * @return array<string, mixed>
     */
    public function createApp(array $payload): array { return $this->request('POST', '/v1/apps', $payload); }

    /**
     * Update an existing app with a new build or settings.
     *
     * @param  string  $publicKey  App public key.
     * @param  array<string, mixed>  $payload  App update payload.
     * @return array<string, mixed>
     */
    public function updateApp(string $publicKey, array $payload): array { return $this->request('POST', '/v1/apps/'.$this->segment($publicKey), $payload); }

    /**
     * Delete one app.
     *
     * @param  string  $publicKey  App public key.
     * @return array<string, mixed>
     */
    public function deleteApp(string $publicKey): array { return $this->request('DELETE', '/v1/apps/'.$this->segment($publicKey)); }

    /**
     * Get account usage summary.
     *
     * @param  array<string, mixed>  $query  nextKey and startMonth query values.
     * @return array<string, mixed>
     */
    public function getUsageSummary(array $query = []): array { return $this->request('GET', '/v1/usageSummary', $query); }

    /**
     * List supported devices and OS versions.
     *
     * @param  array<string, mixed>  $query  Optional filter values.
     * @return array<string, mixed>
     */
    public function listDevices(array $query = []): array { return $this->request('GET', '/v2/service/devices', $query); }

    /**
     * Execute a safe raw GET request.
     *
     * @param  string  $path  Relative Appetize API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array { return $this->request('GET', $this->normalizePath($path), $query); }

    /**
     * Execute a safe raw POST request.
     *
     * @param  string  $path  Relative Appetize API path.
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array { return $this->request('POST', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw DELETE request.
     *
     * @param  string  $path  Relative Appetize API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array { return $this->request('DELETE', $this->normalizePath($path), $query); }

    /**
     * Dispatch an Appetize API request.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Appetize API key is required.');
        }

        $response = $this->rawRequest($method, $path, $data);
        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $this->decodeResponse($response);
    }

    /**
     * Make a raw HTTP request to Appetize.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        $url = $this->baseUrl.$path;
        $http = Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->timeout(30);

        try {
            return match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'DELETE' => $data === [] ? $http->delete($url) : $http->send('DELETE', $url, ['query' => $data]),
                default => throw new RuntimeException("Unsupported Appetize method: {$method}"),
            };
        } catch (\Throwable $e) {
            Log::error("Appetize API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Appetize API: '.$e->getMessage());
        }
    }

    /**
     * Throw a normalized Appetize API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json) ? (string) ($json['message'] ?? $json['error'] ?? '') : '';
        $message = $message !== '' ? $message : trim($response->body());

        Log::error("Appetize API error: {$method} {$path}", ['status' => $response->status(), 'body' => $response->body()]);

        throw new RuntimeException('Appetize API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode a JSON or text Appetize response.
     *
     * @return array<string, mixed>
     */
    private function decodeResponse(Response $response): array
    {
        $body = trim($response->body());
        if ($body === '') {
            return ['success' => true];
        }

        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }

        return ['value' => $body];
    }

    private function segment(string $value): string
    {
        return rawurlencode($value);
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path);
        if ($path === '' || str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            throw new RuntimeException('Appetize API path must be a non-empty relative path.');
        }

        return '/'.ltrim($path, '/');
    }
}
