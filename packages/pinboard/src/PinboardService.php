<?php

namespace OpenCompany\Integrations\Pinboard;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Pinboard v1 API.
 *
 * Handles token authentication, documented endpoint mapping, query shaping,
 * JSON response parsing, and normalized Pinboard API errors.
 */
class PinboardService
{
    private const DEFAULT_BASE_URL = 'https://api.pinboard.in/v1';

    private const OPERATIONS = [
        'posts_update' => ['GET', '/posts/update', [], 'read', 'Posts Update', 'Return the most recent bookmark add, update, or delete time.'],
        'posts_add' => ['GET', '/posts/add', ['url', 'description'], 'write', 'Add Bookmark', 'Add or update a bookmark.'],
        'posts_delete' => ['GET', '/posts/delete', ['url'], 'write', 'Delete Bookmark', 'Delete an existing bookmark.'],
        'posts_get' => ['GET', '/posts/get', [], 'read', 'Get Posts', 'Return one or more posts for a date or URL.'],
        'posts_recent' => ['GET', '/posts/recent', [], 'read', 'Recent Posts', 'Return recent posts, optionally filtered by tag.'],
        'posts_all' => ['GET', '/posts/all', [], 'read', 'All Posts', 'Return all bookmarks in the account.'],
        'posts_dates' => ['GET', '/posts/dates', [], 'read', 'Post Dates', 'Return dates with bookmark counts.'],
        'posts_suggest' => ['GET', '/posts/suggest', ['url'], 'read', 'Suggest Tags', 'Return popular and recommended tags for a URL.'],
        'tags_get' => ['GET', '/tags/get', [], 'read', 'Get Tags', 'Return tags and usage counts.'],
        'tags_delete' => ['GET', '/tags/delete', ['tag'], 'write', 'Delete Tag', 'Delete all instances of a tag.'],
        'tags_rename' => ['GET', '/tags/rename', ['old', 'new'], 'write', 'Rename Tag', 'Rename a tag or fold it into an existing tag.'],
        'user_secret' => ['GET', '/user/secret', [], 'read', 'User Secret', 'Return the secret RSS key.'],
        'user_api_token' => ['GET', '/user/api_token', [], 'read', 'API Token', 'Return the user API token.'],
        'notes_list' => ['GET', '/notes/list', [], 'read', 'List Notes', 'Return a list of notes without note text detail.'],
        'notes_get' => ['GET', '/notes/{note_id}', ['note_id'], 'read', 'Get Note', 'Return an individual note.'],
    ];

    /**
     * @param  string  $authToken  Pinboard auth token, usually username:token.
     * @param  string  $baseUrl  Pinboard v1 API base URL.
     */
    public function __construct(
        private string $authToken = '',
        private string $baseUrl = self::DEFAULT_BASE_URL,
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: self::DEFAULT_BASE_URL, '/');
    }

    /**
     * Check whether credentials are available.
     */
    public function isConfigured(): bool
    {
        return trim($this->authToken) !== '' && trim($this->baseUrl) !== '';
    }

    /**
     * Return the documented Pinboard operation map.
     *
     * @return array<string, array{0: string, 1: string, 2: array<int, string>, 3: string, 4: string, 5: string}>
     */
    public static function operations(): array
    {
        return self::OPERATIONS;
    }

    /**
     * Call a documented Pinboard operation.
     *
     * @param  string  $operation  Operation key from operations().
     * @param  array<string, mixed>  $params  Path or query parameters.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $params = []): array
    {
        $definition = self::OPERATIONS[$operation] ?? null;
        if ($definition === null) {
            throw new RuntimeException("Unsupported Pinboard operation: {$operation}");
        }

        [$method, $path, $required] = $definition;
        foreach ($required as $field) {
            if (($params[$field] ?? '') === '') {
                throw new RuntimeException($field.' is required.');
            }
        }

        return $this->request($method, $this->interpolatePath($path, $params), $params);
    }

    /**
     * Execute a safe raw Pinboard GET request.
     *
     * @param  string  $path  Relative Pinboard API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $query);
    }

    /**
     * Dispatch an authenticated Pinboard request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = []): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Pinboard auth token is required.');
        }

        $query = array_merge(['format' => 'json', 'auth_token' => $this->authToken], $query);
        $response = $this->rawRequest($method, $path, $query);
        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        $decoded = $this->decodeResponse($response);
        if ((string) ($decoded['result_code'] ?? '') === 'something went wrong') {
            throw new RuntimeException('Pinboard API error: something went wrong.');
        }

        return $decoded;
    }

    /**
     * Make a raw HTTP request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function rawRequest(string $method, string $path, array $query): Response
    {
        $url = $this->baseUrl.$path;
        $http = Http::acceptJson()->timeout(30);

        try {
            return match (strtoupper($method)) {
                'GET' => $http->get($url, $query),
                default => throw new RuntimeException("Unsupported Pinboard method: {$method}"),
            };
        } catch (\Throwable $e) {
            Log::error("Pinboard API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Pinboard API: '.$e->getMessage());
        }
    }

    /**
     * Throw a normalized Pinboard API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json) ? (string) ($json['error'] ?? $json['message'] ?? $json['result_code'] ?? '') : trim($response->body());

        Log::error("Pinboard API error: {$method} {$path}", ['status' => $response->status(), 'body' => $response->body()]);

        throw new RuntimeException('Pinboard API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode JSON or text Pinboard responses.
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
            throw new RuntimeException('Pinboard API path must be a non-empty relative path.');
        }

        return '/'.ltrim($path, '/');
    }
}
