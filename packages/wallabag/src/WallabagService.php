<?php

namespace OpenCompany\Integrations\Wallabag;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the wallabag API.
 *
 * Handles OAuth token requests, bearer authentication, documented endpoint
 * mapping, JSON and export response parsing, and normalized API errors.
 */
class WallabagService
{
    private const DEFAULT_BASE_URL = 'https://app.wallabag.it';

    private const OPERATIONS = [
        'token_password' => ['POST', '/oauth/v2/token', 'oauth', ['client_id', 'client_secret', 'username', 'password'], 'write', 'Password Token', 'Exchange wallabag client and user credentials for an access token.'],
        'token_refresh' => ['POST', '/oauth/v2/token', 'oauth', ['client_id', 'client_secret', 'refresh_token'], 'write', 'Refresh Token', 'Refresh a wallabag access token.'],
        'entries_list' => ['GET', '/api/entries.json', 'api', [], 'read', 'List Entries', 'List wallabag entries with filters and pagination.'],
        'entries_create' => ['POST', '/api/entries.json', 'api', ['url'], 'write', 'Create Entry', 'Create a wallabag entry from a URL.'],
        'entries_exists' => ['GET', '/api/entries/exists.json', 'api', ['url'], 'read', 'Entry Exists', 'Check whether a URL already exists in wallabag.'],
        'entries_get' => ['GET', '/api/entries/{entry}.json', 'api', ['entry'], 'read', 'Get Entry', 'Get one wallabag entry.'],
        'entries_update' => ['PATCH', '/api/entries/{entry}.json', 'api', ['entry'], 'write', 'Update Entry', 'Update title, archived/starred state, tags, or other entry fields.'],
        'entries_delete' => ['DELETE', '/api/entries/{entry}.json', 'api', ['entry'], 'write', 'Delete Entry', 'Delete one wallabag entry.'],
        'entries_reload' => ['PATCH', '/api/entries/{entry}/reload.json', 'api', ['entry'], 'write', 'Reload Entry', 'Refetch and reload a wallabag entry.'],
        'entries_export' => ['GET', '/api/entries/{entry}/export.{format}', 'api', ['entry', 'format'], 'read', 'Export Entry', 'Export an entry as epub, mobi, pdf, txt, csv, json, or xml.'],
        'tags_list' => ['GET', '/api/tags.json', 'api', [], 'read', 'List Tags', 'List wallabag tags.'],
        'entry_tags_add' => ['POST', '/api/entries/{entry}/tags.json', 'api', ['entry', 'tags'], 'write', 'Add Entry Tags', 'Add comma-separated tags to an entry.'],
        'entry_tag_delete' => ['DELETE', '/api/entries/{entry}/tags/{tag}.json', 'api', ['entry', 'tag'], 'write', 'Delete Entry Tag', 'Remove one tag from an entry.'],
        'annotations_list' => ['GET', '/api/annotations/{entry}.json', 'api', ['entry'], 'read', 'List Annotations', 'List annotations for a wallabag entry.'],
        'annotations_create' => ['POST', '/api/annotations/{entry}.json', 'api', ['entry', 'text', 'ranges'], 'write', 'Create Annotation', 'Create an annotation for a wallabag entry.'],
        'annotations_update' => ['PUT', '/api/annotations/{annotation}.json', 'api', ['annotation'], 'write', 'Update Annotation', 'Update a wallabag annotation.'],
        'annotations_delete' => ['DELETE', '/api/annotations/{annotation}.json', 'api', ['annotation'], 'write', 'Delete Annotation', 'Delete a wallabag annotation.'],
    ];

    /**
     * @param  string  $accessToken  wallabag bearer access token.
     * @param  string  $clientId  wallabag OAuth client ID.
     * @param  string  $clientSecret  wallabag OAuth client secret.
     * @param  string  $username  wallabag username for password grants.
     * @param  string  $password  wallabag password for password grants.
     * @param  string  $refreshToken  wallabag refresh token.
     * @param  string  $baseUrl  wallabag instance base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $clientId = '',
        private string $clientSecret = '',
        private string $username = '',
        private string $password = '',
        private string $refreshToken = '',
        private string $baseUrl = self::DEFAULT_BASE_URL,
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: self::DEFAULT_BASE_URL, '/');
    }

    /**
     * Check whether bearer credentials are available.
     */
    public function isConfigured(): bool
    {
        return trim($this->accessToken) !== '' && trim($this->baseUrl) !== '';
    }

    /**
     * Return the documented wallabag operation map.
     *
     * @return array<string, array{0: string, 1: string, 2: string, 3: array<int, string>, 4: string, 5: string, 6: string}>
     */
    public static function operations(): array
    {
        return self::OPERATIONS;
    }

    /**
     * Call a documented wallabag operation.
     *
     * @param  string  $operation  Operation key from operations().
     * @param  array<string, mixed>  $params  Path, query, or JSON body fields.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $params = []): array
    {
        $definition = self::OPERATIONS[$operation] ?? null;
        if ($definition === null) {
            throw new RuntimeException("Unsupported wallabag operation: {$operation}");
        }

        [$method, $path, $mode, $required] = $definition;
        if ($operation === 'token_password') {
            $params['grant_type'] = 'password';
        } elseif ($operation === 'token_refresh') {
            $params['grant_type'] = 'refresh_token';
        }

        $params = $this->withDefaultOAuthFields($params, $operation);
        foreach ($required as $field) {
            if (($params[$field] ?? '') === '') {
                throw new RuntimeException($field.' is required.');
            }
        }

        $path = $this->interpolatePath($path, $params);

        return $mode === 'oauth'
            ? $this->oauthRequest($method, $path, $params)
            : $this->apiRequest($method, $path, $params);
    }

    /**
     * Execute a safe raw GET request.
     *
     * @param  string  $path  Relative wallabag API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array { return $this->apiRequest('GET', $this->normalizePath($path), $query); }

    /**
     * Execute a safe raw POST request.
     *
     * @param  string  $path  Relative wallabag API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array { return $this->apiRequest('POST', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw PATCH request.
     *
     * @param  string  $path  Relative wallabag API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array { return $this->apiRequest('PATCH', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw DELETE request.
     *
     * @param  string  $path  Relative wallabag API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array { return $this->apiRequest('DELETE', $this->normalizePath($path), $query); }

    /**
     * Dispatch an OAuth token request.
     *
     * @param  array<string, mixed>  $payload  Form fields.
     * @return array<string, mixed>
     */
    private function oauthRequest(string $method, string $path, array $payload): array
    {
        $response = $this->rawRequest($method, $path, $payload, false);
        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $this->decodeResponse($response);
    }

    /**
     * Dispatch an authenticated API request.
     *
     * @param  array<string, mixed>  $data  Query or JSON body.
     * @return array<string, mixed>
     */
    private function apiRequest(string $method, string $path, array $data = []): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('wallabag access token is required.');
        }

        $response = $this->rawRequest($method, $path, $data, true);
        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $this->decodeResponse($response);
    }

    /**
     * Make a raw HTTP request.
     *
     * @param  array<string, mixed>  $data  Query, form, or JSON body.
     */
    private function rawRequest(string $method, string $path, array $data, bool $authenticated): Response
    {
        $url = $this->baseUrl.$path;
        $headers = ['Accept' => 'application/json'];
        if ($authenticated) {
            $headers['Authorization'] = 'Bearer '.$this->accessToken;
        }

        $http = Http::withHeaders($headers)->timeout(30);

        try {
            return match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $authenticated ? $http->post($url, $data) : $http->asForm()->post($url, $data),
                'PATCH' => $http->patch($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $data === [] ? $http->delete($url) : $http->send('DELETE', $url, ['query' => $data]),
                default => throw new RuntimeException("Unsupported wallabag method: {$method}"),
            };
        } catch (\Throwable $e) {
            Log::error("wallabag API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to wallabag API: '.$e->getMessage());
        }
    }

    /**
     * Merge stored OAuth setup credentials into token requests.
     *
     * @param  array<string, mixed>  $params  Operation parameters.
     * @return array<string, mixed>
     */
    private function withDefaultOAuthFields(array $params, string $operation): array
    {
        if (!str_starts_with($operation, 'token_')) {
            return $params;
        }

        return array_merge([
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'username' => $this->username,
            'password' => $this->password,
            'refresh_token' => $this->refreshToken,
        ], $params);
    }

    /**
     * Throw a normalized wallabag API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json) ? (string) ($json['error_description'] ?? $json['error'] ?? $json['message'] ?? '') : trim($response->body());

        Log::error("wallabag API error: {$method} {$path}", ['status' => $response->status(), 'body' => $response->body()]);

        throw new RuntimeException('wallabag API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode JSON, export text, or empty wallabag responses.
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
            throw new RuntimeException('wallabag API path must be a non-empty relative path.');
        }

        return '/'.ltrim($path, '/');
    }
}
