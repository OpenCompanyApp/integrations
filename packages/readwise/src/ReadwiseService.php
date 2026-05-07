<?php

namespace OpenCompany\Integrations\Readwise;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Readwise v2 and Reader v3 APIs.
 *
 * Handles token authentication, documented endpoint mapping, path parameter
 * interpolation, JSON parsing, and normalized API errors.
 */
class ReadwiseService
{
    private const DEFAULT_BASE_URL = 'https://readwise.io';

    private const OPERATIONS = [
        'check_auth' => ['GET', '/api/v2/auth/'],
        'list_books' => ['GET', '/api/v2/books/'],
        'get_book' => ['GET', '/api/v2/books/{book_id}/'],
        'list_book_tags' => ['GET', '/api/v2/books/{book_id}/tags'],
        'create_book_tag' => ['POST', '/api/v2/books/{book_id}/tags'],
        'delete_book_tag' => ['DELETE', '/api/v2/books/{book_id}/tags/{tag_id}'],
        'list_highlights' => ['GET', '/api/v2/highlights/'],
        'create_highlights' => ['POST', '/api/v2/highlights/'],
        'get_highlight' => ['GET', '/api/v2/highlights/{highlight_id}/'],
        'update_highlight' => ['PATCH', '/api/v2/highlights/{highlight_id}/'],
        'delete_highlight' => ['DELETE', '/api/v2/highlights/{highlight_id}/'],
        'list_highlight_tags' => ['GET', '/api/v2/highlights/{highlight_id}/tags'],
        'create_highlight_tag' => ['POST', '/api/v2/highlights/{highlight_id}/tags'],
        'delete_highlight_tag' => ['DELETE', '/api/v2/highlights/{highlight_id}/tags/{tag_id}'],
        'export_highlights' => ['GET', '/api/v2/export/'],
        'get_review_queue' => ['GET', '/api/v2/review/'],
        'list_documents' => ['GET', '/api/v3/list/'],
        'save_document' => ['POST', '/api/v3/save/'],
        'update_document' => ['PATCH', '/api/v3/update/{document_id}/'],
        'bulk_update_documents' => ['PATCH', '/api/v3/bulk_update/'],
        'delete_document' => ['DELETE', '/api/v3/delete/{document_id}/'],
        'list_reader_tags' => ['GET', '/api/v3/tags/'],
    ];

    /**
     * @param  string  $accessToken  Readwise access token.
     * @param  string  $baseUrl  Readwise API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = self::DEFAULT_BASE_URL,
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: self::DEFAULT_BASE_URL, '/');
    }

    /**
     * Check whether credentials are available.
     */
    public function isConfigured(): bool
    {
        return trim($this->accessToken) !== '' && trim($this->baseUrl) !== '';
    }

    /**
     * Return the documented Readwise operation map.
     *
     * @return array<string, array{0: string, 1: string}>
     */
    public static function operations(): array
    {
        return self::OPERATIONS;
    }

    /**
     * Call a documented Readwise or Reader operation.
     *
     * @param  string  $operation  Operation key from operations().
     * @param  array<string, mixed>  $params  Path, query, or JSON body parameters.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $params = []): array
    {
        $definition = self::OPERATIONS[$operation] ?? null;
        if ($definition === null) {
            throw new RuntimeException("Unsupported Readwise operation: {$operation}");
        }

        [$method, $path] = $definition;

        return $this->request($method, $this->interpolatePath($path, $params), $params);
    }

    /**
     * Execute a safe raw GET request.
     *
     * @param  string  $path  Relative Readwise API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array { return $this->request('GET', $this->normalizePath($path), $query); }

    /**
     * Execute a safe raw POST request.
     *
     * @param  string  $path  Relative Readwise API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array { return $this->request('POST', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw PATCH request.
     *
     * @param  string  $path  Relative Readwise API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array { return $this->request('PATCH', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw DELETE request.
     *
     * @param  string  $path  Relative Readwise API path.
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
            throw new RuntimeException('Readwise access token is required.');
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
            'Authorization' => 'Token '.$this->accessToken,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->timeout(30);

        try {
            return match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $data === [] ? $http->delete($url) : $http->send('DELETE', $url, ['query' => $data]),
                default => throw new RuntimeException("Unsupported Readwise method: {$method}"),
            };
        } catch (\Throwable $e) {
            Log::error("Readwise API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Readwise API: '.$e->getMessage());
        }
    }

    /**
     * Throw a normalized Readwise API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json) ? (string) ($json['detail'] ?? $json['message'] ?? $json['error'] ?? '') : '';
        $message = $message !== '' ? $message : trim($response->body());

        Log::error("Readwise API error: {$method} {$path}", ['status' => $response->status(), 'body' => $response->body()]);

        throw new RuntimeException('Readwise API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode JSON, text, or empty Readwise responses.
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

    /**
     * Interpolate path variables and remove them from request data.
     *
     * @param  array<string, mixed>  $params  Request data.
     */
    private function interpolatePath(string $path, array &$params): string
    {
        return preg_replace_callback('/\{([^}]+)\}/', function (array $matches) use (&$params): string {
            $key = $matches[1];
            $value = $params[$key] ?? null;
            if ($value === null || $value === '') {
                throw new RuntimeException($key.' is required.');
            }

            unset($params[$key]);

            return rawurlencode((string) $value);
        }, $path) ?? $path;
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path);
        if ($path === '' || str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            throw new RuntimeException('Readwise API path must be a non-empty relative path.');
        }

        return '/'.ltrim($path, '/');
    }
}
