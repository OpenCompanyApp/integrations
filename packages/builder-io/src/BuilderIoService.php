<?php

namespace OpenCompany\Integrations\BuilderIo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Builder.io CDN API covering models, content, symbols, and user info.
 *
 * Wraps the Builder.io API v2 and handles authentication, request routing,
 * and error reporting for a given API key.
 */
class BuilderIoService
{
    private string $baseUrl = 'https://cdn.builder.io/api/v2';

    /**
     * @param  string  $apiKey  Builder.io API key (bearer token)
     */
    public function __construct(
        private string $apiKey = '',
    ) {}

    /**
     * Check whether the service has sufficient credentials to make API calls.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    // ── Models ─────────────────────────────────────────────

    /**
     * List all models.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. limit, offset)
     * @return array<string, mixed>
     */
    public function listModels(array $params = []): array
    {
        return $this->request('GET', '/models', $params);
    }

    /**
     * Get a single model by ID or name.
     *
     * @return array<string, mixed>
     */
    public function getModel(string $modelIdOrName): array
    {
        return $this->request('GET', "/models/{$modelIdOrName}");
    }

    // ── Content ────────────────────────────────────────────

    /**
     * List content entries for a model.
     *
     * @param  string  $modelName  The model name (used as the URL path segment)
     * @param  array<string, mixed>  $params  Query parameters (e.g. limit, offset, query, fields)
     * @return array<string, mixed>
     */
    public function listContent(string $modelName, array $params = []): array
    {
        return $this->request('GET', "/content/{$modelName}", $params);
    }

    /**
     * Get a single content entry by ID.
     *
     * @param  string  $contentId  The content entry ID
     * @return array<string, mixed>
     */
    public function getContent(string $contentId): array
    {
        return $this->request('GET', "/content/{$contentId}");
    }

    /**
     * Create a new content entry.
     *
     * @param  string  $modelName  The model name for the content
     * @param  array<string, mixed>  $body  Content data (name, data, etc.)
     * @return array<string, mixed>
     */
    public function createContent(string $modelName, array $body): array
    {
        return $this->request('POST', "/content/{$modelName}", $body);
    }

    // ── Symbols ────────────────────────────────────────────

    /**
     * List all symbols.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. limit, offset)
     * @return array<string, mixed>
     */
    public function listSymbols(array $params = []): array
    {
        return $this->request('GET', '/symbols', $params);
    }

    // ── User ───────────────────────────────────────────────

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request to the Builder.io API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API path relative to the base URL
     * @param  array<string, mixed>  $data  Query params (GET) or body data (POST/PUT)
     * @param  array<string, string>  $extraHeaders  Additional headers
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], array $extraHeaders = []): array
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('Builder.io API key is not configured.');
        }

        try {
            $headers = array_merge([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ], $extraHeaders);

            $http = Http::withHeaders($headers)->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($this->baseUrl . $path, $data),
                'POST' => $http->post($this->baseUrl . $path, $data),
                'PUT' => $http->put($this->baseUrl . $path, $data),
                'DELETE' => $http->delete($this->baseUrl . $path, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $err = $body['message'] ?? $body['error'] ?? $response->body();

                Log::error("Builder.io API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $err,
                ]);

                $msg = is_string($err) ? $err : json_encode($err);

                throw new \RuntimeException('Builder.io API error (' . $response->status() . '): ' . $msg);
            }

            // DELETE may return 204 No Content
            if ($response->status() === 204) {
                return ['deleted' => true];
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Builder.io API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Builder.io API: {$e->getMessage()}");
        }
    }
}
