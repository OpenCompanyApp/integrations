<?php

namespace OpenCompany\Integrations\Featurebase;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Featurebase 2026-01-01.nova REST API.
 *
 * Handles Bearer authentication, API-version pinning, documented endpoint
 * mapping, path parameter interpolation, and normalized API errors.
 */
class FeaturebaseService
{
    private const DEFAULT_BASE_URL = 'https://do.featurebase.app';

    private const DEFAULT_VERSION = '2026-01-01.nova';

    /**
     * @param  string  $apiKey  Featurebase API key.
     * @param  string  $baseUrl  Featurebase production or mock API base URL.
     * @param  string  $apiVersion  Featurebase API version header value.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = self::DEFAULT_BASE_URL,
        private string $apiVersion = self::DEFAULT_VERSION,
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: self::DEFAULT_BASE_URL, '/');
        $this->apiVersion = $this->apiVersion ?: self::DEFAULT_VERSION;
    }

    /**
     * Check whether credentials are available.
     */
    public function isConfigured(): bool
    {
        return trim($this->apiKey) !== '' && trim($this->baseUrl) !== '';
    }

    /**
     * Return documented Featurebase operations keyed by operation id.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function operations(): array
    {
        return FeaturebaseOperations::all();
    }

    /**
     * Call a documented Featurebase operation.
     *
     * @param  string  $operation  Operation key from operations().
     * @param  array<string, mixed>  $params  Path, query, or JSON body parameters.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $params = []): array
    {
        $definition = self::operations()[$operation] ?? null;
        if ($definition === null) {
            throw new RuntimeException("Unsupported Featurebase operation: {$operation}");
        }

        return $this->request(
            (string) $definition['method'],
            $this->interpolatePath((string) $definition['path'], $params),
            $params,
        );
    }

    /**
     * Execute a safe raw GET request.
     *
     * @param  string  $path  Relative Featurebase API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array { return $this->request('GET', $this->normalizePath($path), $query); }

    /**
     * Execute a safe raw POST request.
     *
     * @param  string  $path  Relative Featurebase API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array { return $this->request('POST', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw PATCH request.
     *
     * @param  string  $path  Relative Featurebase API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array { return $this->request('PATCH', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw DELETE request.
     *
     * @param  string  $path  Relative Featurebase API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array { return $this->request('DELETE', $this->normalizePath($path), $query); }

    /**
     * Dispatch an authenticated HTTP request.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Featurebase API key is required.');
        }

        $response = $this->rawRequest($method, $path, $data);
        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $this->decodeResponse($response);
    }

    /**
     * Make a raw HTTP request.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        $url = $this->baseUrl.$path;
        $http = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->apiKey,
            'Featurebase-Version' => $this->apiVersion,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->timeout(30);

        try {
            return match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $data === [] ? $http->delete($url) : $http->send('DELETE', $url, ['query' => $data]),
                default => throw new RuntimeException("Unsupported Featurebase method: {$method}"),
            };
        } catch (\Throwable $e) {
            Log::error("Featurebase API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Featurebase API: '.$e->getMessage());
        }
    }

    /**
     * Throw a normalized Featurebase API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $error = is_array($json) ? ($json['error'] ?? []) : [];
        $message = is_array($error) ? (string) ($error['message'] ?? '') : '';
        $message = $message !== '' ? $message : (is_array($json) ? (string) ($json['message'] ?? '') : '');
        $message = $message !== '' ? $message : trim($response->body());

        Log::error("Featurebase API error: {$method} {$path}", ['status' => $response->status(), 'body' => $response->body()]);

        throw new RuntimeException('Featurebase API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode JSON, text, or empty Featurebase responses.
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
            return array_is_list($json) ? ['items' => $json] : $json;
        }

        return ['value' => $body];
    }

    /**
     * Interpolate path variables and remove them from request data.
     *
     * @param  array<string, mixed>  $params  Request data.
     */
    private function interpolatePath(string $path, array &$params): string
    {
        return preg_replace_callback('/\{([^}]+)\}/', function (array $matches) use (&$params): string {
            $key = $matches[1];
            $snake = $this->snake($key);
            $value = $params[$key] ?? ($params[$snake] ?? null);
            if ($value === null || $value === '') {
                throw new RuntimeException($snake.' is required.');
            }

            unset($params[$key], $params[$snake]);

            return rawurlencode((string) $value);
        }, $path) ?? $path;
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path);
        if ($path === '' || str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            throw new RuntimeException('Featurebase API path must be a non-empty relative path.');
        }

        return '/'.ltrim($path, '/');
    }

    private function snake(string $value): string
    {
        return strtolower((string) preg_replace('/(?<!^)[A-Z]/', '_$0', $value));
    }
}
