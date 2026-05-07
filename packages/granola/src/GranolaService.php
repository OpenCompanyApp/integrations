<?php

namespace OpenCompany\Integrations\Granola;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Granola Enterprise API.
 *
 * Handles bearer authentication and exposes the current public read-only API
 * for notes and folders.
 */
class GranolaService
{
    /**
     * @param  string  $apiKey  Granola Enterprise API bearer token.
     * @param  string  $baseUrl  Granola public API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://public-api.granola.ai/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * List accessible meeting notes.
     *
     * @param  array<string, mixed>  $params  Query parameters (created_before, created_after, updated_after, cursor, page_size).
     * @return array<string, mixed>
     */
    public function listNotes(array $params = []): array
    {
        return $this->request('GET', '/notes', $this->onlyKeys($params, [
            'created_before',
            'created_after',
            'updated_after',
            'cursor',
            'page_size',
        ]));
    }

    /**
     * Retrieve a single meeting note by ID.
     *
     * @param  string  $noteId  Granola note ID.
     * @return array<string, mixed>
     */
    public function getNote(string $noteId): array
    {
        return $this->request('GET', '/notes/'.$this->path($noteId));
    }

    /**
     * List accessible folders.
     *
     * @param  array<string, mixed>  $params  Query parameters (cursor, page_size).
     * @return array<string, mixed>
     */
    public function listFolders(array $params = []): array
    {
        return $this->request('GET', '/folders', $this->onlyKeys($params, [
            'cursor',
            'page_size',
        ]));
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        $json = $response->json();

        if (is_array($json)) {
            return $json;
        }

        $body = $response->body();

        return $body === '' ? ['success' => true] : ['response' => $body];
    }

    /**
     * Make a raw HTTP request to the Granola API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters.
     * @return Response
     *
     * @throws RuntimeException On configuration, connection, or API errors.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->apiKey) {
            throw new RuntimeException('Granola API key is not configured.');
        }

        $url = $this->baseUrl.$path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer '.$this->apiKey,
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Granola API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Granola API: {$e->getMessage()}");
        }
    }

    /**
     * Throw a normalized API error.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  Response  $response  Failed response.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $contentType = $response->header('Content-Type') ?? '';
        $body = $response->body();

        if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
            Log::warning("Granola API returned HTML for {$method} {$path}", [
                'status' => $response->status(),
            ]);

            throw new RuntimeException("Granola API endpoint not available (HTTP {$response->status()}). Check the configured public API URL.");
        }

        $error = $response->json('error') ?? $response->json('message') ?? $body;

        Log::error("Granola API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new RuntimeException("Granola API error ({$response->status()}): ".(is_string($error) ? $error : json_encode($error)));
    }

    /**
     * Keep only supported query parameters and remove nulls.
     *
     * @param  array<string, mixed>  $data  Source query parameters.
     * @param  array<int, string>  $keys  Allowed query parameter names.
     * @return array<string, mixed>
     */
    private function onlyKeys(array $data, array $keys): array
    {
        return array_filter(array_intersect_key($data, array_flip($keys)), static fn (mixed $value): bool => $value !== null);
    }

    /**
     * URL-encode a path segment.
     *
     * @param  string  $value  Path segment value.
     */
    private function path(string $value): string
    {
        return rawurlencode($value);
    }
}
