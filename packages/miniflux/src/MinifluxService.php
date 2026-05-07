<?php

namespace OpenCompany\Integrations\Miniflux;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Miniflux REST API.
 *
 * Handles API-token or Basic authentication, documented endpoint mapping,
 * OPML/XML request bodies, response parsing, and normalized API errors.
 */
class MinifluxService
{
    private const DEFAULT_BASE_URL = 'https://miniflux.example';

    private const OPERATIONS = [
        'discover' => ['POST', '/v1/discover', ['url'], 'read', 'Discover Subscriptions', 'Discover feeds from a website URL.'],
        'flush_history' => ['PUT', '/v1/flush-history', [], 'write', 'Flush History', 'Flush removed entry history.'],
        'feeds_list' => ['GET', '/v1/feeds', [], 'read', 'List Feeds', 'List feeds visible to the authenticated user.'],
        'category_feeds_list' => ['GET', '/v1/categories/{category_id}/feeds', ['category_id'], 'read', 'List Category Feeds', 'List feeds in one category.'],
        'feeds_get' => ['GET', '/v1/feeds/{feed_id}', ['feed_id'], 'read', 'Get Feed', 'Get one feed.'],
        'feed_icon_get' => ['GET', '/v1/feeds/{feed_id}/icon', ['feed_id'], 'read', 'Get Feed Icon', 'Get a feed icon by feed ID.'],
        'icon_get' => ['GET', '/v1/icons/{icon_id}', ['icon_id'], 'read', 'Get Icon', 'Get a feed icon by icon ID.'],
        'feeds_mark_all_read' => ['PUT', '/v1/feeds/{feed_id}/mark-all-as-read', ['feed_id'], 'write', 'Mark Feed Read', 'Mark all entries in one feed as read.'],
        'feeds_create' => ['POST', '/v1/feeds', ['feed_url'], 'write', 'Create Feed', 'Subscribe to a feed URL.'],
        'feeds_update' => ['PUT', '/v1/feeds/{feed_id}', ['feed_id'], 'write', 'Update Feed', 'Update feed settings.'],
        'feeds_refresh' => ['PUT', '/v1/feeds/{feed_id}/refresh', ['feed_id'], 'write', 'Refresh Feed', 'Refresh one feed synchronously.'],
        'feeds_refresh_all' => ['PUT', '/v1/feeds/refresh', [], 'write', 'Refresh All Feeds', 'Refresh all feeds in the background.'],
        'feeds_delete' => ['DELETE', '/v1/feeds/{feed_id}', ['feed_id'], 'write', 'Delete Feed', 'Remove one feed.'],
        'feed_entry_get' => ['GET', '/v1/feeds/{feed_id}/entries/{entry_id}', ['feed_id', 'entry_id'], 'read', 'Get Feed Entry', 'Get one entry scoped to a feed.'],
        'entries_get' => ['GET', '/v1/entries/{entry_id}', ['entry_id'], 'read', 'Get Entry', 'Get one entry.'],
        'entries_import' => ['POST', '/v1/feeds/{feed_id}/entries/import', ['feed_id', 'url'], 'write', 'Import Entry', 'Import a manual entry into a feed.'],
        'entries_update' => ['PUT', '/v1/entries/{entry_id}', ['entry_id'], 'write', 'Update Entry', 'Update one entry title or content.'],
        'entries_save' => ['POST', '/v1/entries/{entry_id}/save', ['entry_id'], 'write', 'Save Entry', 'Save one entry to configured third-party services.'],
        'entries_fetch_content' => ['GET', '/v1/entries/{entry_id}/fetch-content', ['entry_id'], 'read', 'Fetch Original Article', 'Fetch original article content for one entry.'],
        'feed_entries_list' => ['GET', '/v1/feeds/{feed_id}/entries', ['feed_id'], 'read', 'List Feed Entries', 'List entries from one feed.'],
        'category_entries_list' => ['GET', '/v1/categories/{category_id}/entries', ['category_id'], 'read', 'List Category Entries', 'List entries from one category.'],
        'entries_list' => ['GET', '/v1/entries', [], 'read', 'List Entries', 'List entries with filters and pagination.'],
        'entries_update_status' => ['PUT', '/v1/entries', ['entry_ids', 'status'], 'write', 'Update Entry Statuses', 'Batch update entry read status.'],
        'entries_toggle_bookmark' => ['PUT', '/v1/entries/{entry_id}/bookmark', ['entry_id'], 'write', 'Toggle Bookmark', 'Toggle one entry bookmark.'],
        'enclosures_get' => ['GET', '/v1/enclosures/{enclosure_id}', ['enclosure_id'], 'read', 'Get Enclosure', 'Get one media enclosure.'],
        'enclosures_update' => ['PUT', '/v1/enclosures/{enclosure_id}', ['enclosure_id'], 'write', 'Update Enclosure', 'Update enclosure media progression.'],
        'categories_list' => ['GET', '/v1/categories', [], 'read', 'List Categories', 'List categories, optionally with counts.'],
        'categories_create' => ['POST', '/v1/categories', ['title'], 'write', 'Create Category', 'Create a category.'],
        'categories_update' => ['PUT', '/v1/categories/{category_id}', ['category_id'], 'write', 'Update Category', 'Update a category.'],
        'categories_refresh' => ['PUT', '/v1/categories/{category_id}/refresh', ['category_id'], 'write', 'Refresh Category Feeds', 'Refresh feeds in one category.'],
        'categories_delete' => ['DELETE', '/v1/categories/{category_id}', ['category_id'], 'write', 'Delete Category', 'Delete one category.'],
        'categories_mark_all_read' => ['PUT', '/v1/categories/{category_id}/mark-all-as-read', ['category_id'], 'write', 'Mark Category Read', 'Mark all entries in one category as read.'],
        'opml_export' => ['GET', '/v1/export', [], 'read', 'Export OPML', 'Export subscriptions as OPML XML.'],
        'opml_import' => ['POST', '/v1/import', ['opml'], 'write', 'Import OPML', 'Import subscriptions from OPML XML.'],
        'users_create' => ['POST', '/v1/users', ['username', 'password'], 'write', 'Create User', 'Create a Miniflux user as an administrator.'],
        'users_update' => ['PUT', '/v1/users/{user_id}', ['user_id'], 'write', 'Update User', 'Update a Miniflux user as an administrator.'],
        'me_get' => ['GET', '/v1/me', [], 'read', 'Get Current User', 'Get the authenticated user.'],
        'users_get' => ['GET', '/v1/users/{user_id}', ['user_id'], 'read', 'Get User', 'Get a user by ID or username as an administrator.'],
        'users_list' => ['GET', '/v1/users', [], 'read', 'List Users', 'List users as an administrator.'],
        'users_delete' => ['DELETE', '/v1/users/{user_id}', ['user_id'], 'write', 'Delete User', 'Delete a user as an administrator.'],
        'integrations_status' => ['GET', '/integrations/status', [], 'read', 'Integrations Status', 'Check whether the user has third-party save integrations enabled.'],
        'users_mark_all_read' => ['PUT', '/v1/users/{user_id}/mark-all-as-read', ['user_id'], 'write', 'Mark User Read', 'Mark all entries for one user as read.'],
        'feed_counters_get' => ['GET', '/v1/feeds/counters', [], 'read', 'Get Feed Counters', 'Fetch read and unread counters per feed.'],
        'api_keys_list' => ['GET', '/v1/api-keys', [], 'read', 'List API Keys', 'List API keys for the authenticated user.'],
        'api_keys_create' => ['POST', '/v1/api-keys', ['description'], 'write', 'Create API Key', 'Create an API key for the authenticated user.'],
        'api_keys_delete' => ['DELETE', '/v1/api-keys/{api_key_id}', ['api_key_id'], 'write', 'Delete API Key', 'Delete an API key.'],
        'healthcheck' => ['GET', '/healthcheck', [], 'read', 'Healthcheck', 'Check service and database health.'],
        'liveness' => ['GET', '/liveness', [], 'read', 'Liveness', 'Check process liveness.'],
        'readiness' => ['GET', '/readiness', [], 'read', 'Readiness', 'Check readiness to accept traffic.'],
        'version_legacy' => ['GET', '/version', [], 'read', 'Legacy Version', 'Fetch the deprecated plain-text version endpoint.'],
        'version_get' => ['GET', '/v1/version', [], 'read', 'Version', 'Fetch version and build information.'],
    ];

    /**
     * @param  string  $apiKey  Miniflux API token for X-Auth-Token authentication.
     * @param  string  $username  Miniflux username for Basic authentication fallback.
     * @param  string  $password  Miniflux password for Basic authentication fallback.
     * @param  string  $baseUrl  Miniflux instance root URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $username = '',
        private string $password = '',
        private string $baseUrl = self::DEFAULT_BASE_URL,
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: self::DEFAULT_BASE_URL, '/');
    }

    /**
     * Check whether credentials and an instance URL are available.
     */
    public function isConfigured(): bool
    {
        return trim($this->baseUrl) !== '' && (trim($this->apiKey) !== '' || (trim($this->username) !== '' && trim($this->password) !== ''));
    }

    /**
     * Return the documented Miniflux operation map.
     *
     * @return array<string, array{0: string, 1: string, 2: array<int, string>, 3: string, 4: string, 5: string}>
     */
    public static function operations(): array
    {
        return self::OPERATIONS;
    }

    /**
     * Call a documented Miniflux operation.
     *
     * @param  string  $operation  Operation key from operations().
     * @param  array<string, mixed>  $params  Path, query, or JSON body fields.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $params = []): array
    {
        $definition = self::OPERATIONS[$operation] ?? null;
        if ($definition === null) {
            throw new RuntimeException("Unsupported Miniflux operation: {$operation}");
        }

        [$method, $path, $required] = $definition;
        foreach ($required as $field) {
            if (!array_key_exists($field, $params) || $params[$field] === '' || $params[$field] === []) {
                throw new RuntimeException($field.' is required.');
            }
        }

        return $this->request($method, $this->interpolatePath($path, $params), $params, $operation === 'opml_import');
    }

    /**
     * Execute a safe raw GET request.
     *
     * @param  string  $path  Relative Miniflux API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array { return $this->request('GET', $this->normalizePath($path), $query); }

    /**
     * Execute a safe raw POST request.
     *
     * @param  string  $path  Relative Miniflux API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array { return $this->request('POST', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw PUT request.
     *
     * @param  string  $path  Relative Miniflux API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $payload = []): array { return $this->request('PUT', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw PATCH request.
     *
     * @param  string  $path  Relative Miniflux API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array { return $this->request('PATCH', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw DELETE request.
     *
     * @param  string  $path  Relative Miniflux API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array { return $this->request('DELETE', $this->normalizePath($path), $query); }

    /**
     * Dispatch an authenticated Miniflux request.
     *
     * @param  array<string, mixed>  $data  Query or body fields.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], bool $xml = false): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Miniflux integration is not configured.');
        }

        $response = $this->rawRequest($method, $path, $data, $xml);
        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $this->decodeResponse($response);
    }

    /**
     * Make a raw HTTP request.
     *
     * @param  array<string, mixed>  $data  Query or body fields.
     */
    private function rawRequest(string $method, string $path, array $data, bool $xml): Response
    {
        $url = $this->baseUrl.$path;
        $http = Http::acceptJson()->timeout(30);

        if (trim($this->apiKey) !== '') {
            $http = $http->withHeaders(['X-Auth-Token' => $this->apiKey]);
        } else {
            $http = $http->withBasicAuth($this->username, $this->password);
        }

        try {
            if ($xml) {
                return $http->withBody((string) $data['opml'], 'text/xml')->post($url);
            }

            return match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->asJson()->post($url, $data),
                'PUT' => $http->asJson()->put($url, $data),
                'PATCH' => $http->asJson()->patch($url, $data),
                'DELETE' => $data === [] ? $http->delete($url) : $http->send('DELETE', $url, ['json' => $data]),
                default => throw new RuntimeException("Unsupported Miniflux method: {$method}"),
            };
        } catch (\Throwable $e) {
            Log::error("Miniflux API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Miniflux API: '.$e->getMessage());
        }
    }

    /**
     * Throw a normalized Miniflux API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json) ? (string) ($json['error_message'] ?? $json['error'] ?? $json['message'] ?? '') : trim($response->body());

        Log::error("Miniflux API error: {$method} {$path}", ['status' => $response->status(), 'body' => $response->body()]);

        throw new RuntimeException('Miniflux API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode JSON, text/XML, or empty Miniflux responses.
     *
     * @return array<string, mixed>
     */
    private function decodeResponse(Response $response): array
    {
        $body = trim($response->body());
        $base = ['status' => $response->status()];

        if ($body === '') {
            return array_merge($base, ['success' => true]);
        }

        $json = $response->json();
        if (is_array($json)) {
            return array_merge($base, ['data' => $json]);
        }

        return array_merge($base, ['value' => $body]);
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
            throw new RuntimeException('Miniflux API path must be a non-empty relative path.');
        }

        return '/'.ltrim($path, '/');
    }
}
