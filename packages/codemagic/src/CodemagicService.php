<?php

namespace OpenCompany\Integrations\Codemagic;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Codemagic REST API.
 *
 * Handles x-auth-token authentication, JSON response parsing, and normalized
 * API errors for applications, builds, artifacts, caches, and raw calls.
 */
class CodemagicService
{
    /**
     * @param  string  $apiToken  Codemagic API token.
     * @param  string  $baseUrl  Codemagic API base URL.
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://api.codemagic.io',
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: 'https://api.codemagic.io', '/');
    }

    /**
     * Check whether the service has credentials configured.
     */
    public function isConfigured(): bool
    {
        return trim($this->apiToken) !== '' && trim($this->baseUrl) !== '';
    }

    /**
     * Retrieve all applications.
     *
     * @param  array<string, mixed>  $query  Optional query parameters.
     * @return array<string, mixed>
     */
    public function listApps(array $query = []): array { return $this->request('GET', '/apps', $query); }

    /**
     * Retrieve one application.
     *
     * @return array<string, mixed>
     */
    public function getApp(string $appId): array { return $this->request('GET', '/apps/'.$this->segment($appId)); }

    /**
     * Add a new application from repository URL.
     *
     * @param  array<string, mixed>  $payload  Application payload.
     * @return array<string, mixed>
     */
    public function createApp(array $payload): array { return $this->request('POST', '/apps', $payload); }

    /**
     * Add a new application from a private repository with SSH key details.
     *
     * @param  array<string, mixed>  $payload  Private app payload.
     * @return array<string, mixed>
     */
    public function createPrivateApp(array $payload): array { return $this->request('POST', '/apps/new', $payload); }

    /**
     * Start a new Codemagic build.
     *
     * @param  array<string, mixed>  $payload  Build payload.
     * @return array<string, mixed>
     */
    public function startBuild(array $payload): array { return $this->request('POST', '/builds', $payload); }

    /**
     * Cancel a Codemagic build.
     *
     * @return array<string, mixed>
     */
    public function cancelBuild(string $buildId): array { return $this->request('POST', '/builds/'.$this->segment($buildId).'/cancel'); }

    /**
     * Get an authenticated artifact download URL.
     *
     * @return array<string, mixed>
     */
    public function getArtifact(string $secureFilename): array { return $this->request('GET', '/artifacts/'.$this->path($secureFilename)); }

    /**
     * Create a public artifact URL.
     *
     * @param  array<string, mixed>  $payload  Public URL payload such as expiresAt.
     * @return array<string, mixed>
     */
    public function createArtifactPublicUrl(string $secureFilename, array $payload): array { return $this->request('POST', '/artifacts/'.$this->path($secureFilename).'/public-url', $payload); }

    /**
     * List caches for an application.
     *
     * @return array<string, mixed>
     */
    public function listCaches(string $appId): array { return $this->request('GET', '/apps/'.$this->segment($appId).'/caches'); }

    /**
     * Delete all caches for an application.
     *
     * @return array<string, mixed>
     */
    public function deleteCaches(string $appId): array { return $this->request('DELETE', '/apps/'.$this->segment($appId).'/caches'); }

    /**
     * Delete one cache for an application.
     *
     * @return array<string, mixed>
     */
    public function deleteCache(string $appId, string $cacheId): array { return $this->request('DELETE', '/apps/'.$this->segment($appId).'/caches/'.$this->segment($cacheId)); }

    /**
     * Execute a safe raw GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array { return $this->request('GET', $this->normalizePath($path), $query); }

    /**
     * Execute a safe raw POST request.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array { return $this->request('POST', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw PATCH request.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array { return $this->request('PATCH', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw DELETE request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array { return $this->request('DELETE', $this->normalizePath($path), $query); }

    /**
     * Dispatch a Codemagic API request.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Codemagic API token is required.');
        }

        $response = $this->rawRequest($method, $path, $data);
        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $this->decodeResponse($response);
    }

    /**
     * Make a raw HTTP request to Codemagic.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        $url = $this->baseUrl.$path;
        $http = Http::withHeaders([
            'x-auth-token' => $this->apiToken,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->timeout(30);

        try {
            return match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $data === [] ? $http->delete($url) : $http->send('DELETE', $url, ['query' => $data]),
                default => throw new RuntimeException("Unsupported Codemagic method: {$method}"),
            };
        } catch (\Throwable $e) {
            Log::error("Codemagic API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Codemagic API: '.$e->getMessage());
        }
    }

    /**
     * Throw a normalized Codemagic API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json) ? (string) ($json['message'] ?? $json['error'] ?? '') : '';
        $message = $message !== '' ? $message : trim($response->body());

        Log::error("Codemagic API error: {$method} {$path}", ['status' => $response->status(), 'body' => $response->body()]);

        throw new RuntimeException('Codemagic API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode a JSON or text Codemagic response.
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

    private function path(string $value): string
    {
        return implode('/', array_map('rawurlencode', explode('/', ltrim($value, '/'))));
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path);
        if ($path === '' || str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            throw new RuntimeException('Codemagic API path must be a non-empty relative path.');
        }

        return '/'.ltrim($path, '/');
    }
}
