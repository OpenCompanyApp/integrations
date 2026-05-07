<?php

namespace OpenCompany\Integrations\Feedbin;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Feedbin API V2.
 *
 * Handles Basic authentication, documented endpoint mapping, JSON/XML request
 * encoding, response parsing, and normalized API errors.
 */
class FeedbinService
{
    private const DEFAULT_BASE_URL = 'https://api.feedbin.com/v2';

    private const OPERATIONS = [
        'authentication_check' => ['GET', '/authentication.json', [], 'read', 'Check Authentication', 'Verify Feedbin Basic auth credentials.'],
        'subscriptions_list' => ['GET', '/subscriptions.json', [], 'read', 'List Subscriptions', 'List Feedbin subscriptions.'],
        'subscriptions_get' => ['GET', '/subscriptions/{subscription_id}.json', ['subscription_id'], 'read', 'Get Subscription', 'Get one subscription.'],
        'subscriptions_create' => ['POST', '/subscriptions.json', ['feed_url'], 'write', 'Create Subscription', 'Subscribe to a feed URL or website URL.'],
        'subscriptions_update' => ['PATCH', '/subscriptions/{subscription_id}.json', ['subscription_id'], 'write', 'Update Subscription', 'Set a custom subscription title.'],
        'subscriptions_update_post' => ['POST', '/subscriptions/{subscription_id}/update.json', ['subscription_id'], 'write', 'Update Subscription POST', 'POST fallback for subscription updates.'],
        'subscriptions_delete' => ['DELETE', '/subscriptions/{subscription_id}.json', ['subscription_id'], 'write', 'Delete Subscription', 'Delete a subscription.'],
        'feeds_get' => ['GET', '/feeds/{feed_id}.json', ['feed_id'], 'read', 'Get Feed', 'Get one Feedbin feed.'],
        'entries_list' => ['GET', '/entries.json', [], 'read', 'List Entries', 'List entries with filters and pagination.'],
        'feed_entries_list' => ['GET', '/feeds/{feed_id}/entries.json', ['feed_id'], 'read', 'List Feed Entries', 'List entries for one feed.'],
        'entries_get' => ['GET', '/entries/{entry_id}.json', ['entry_id'], 'read', 'Get Entry', 'Get one entry.'],
        'unread_entries_list' => ['GET', '/unread_entries.json', [], 'read', 'List Unread Entry IDs', 'List unread entry IDs.'],
        'unread_entries_create' => ['POST', '/unread_entries.json', ['unread_entries'], 'write', 'Mark Unread', 'Mark entry IDs as unread.'],
        'unread_entries_delete' => ['DELETE', '/unread_entries.json', ['unread_entries'], 'write', 'Mark Read', 'Mark entry IDs as read.'],
        'unread_entries_delete_post' => ['POST', '/unread_entries/delete.json', ['unread_entries'], 'write', 'Mark Read POST', 'POST fallback for marking read.'],
        'starred_entries_list' => ['GET', '/starred_entries.json', [], 'read', 'List Starred Entry IDs', 'List starred entry IDs.'],
        'starred_entries_create' => ['POST', '/starred_entries.json', ['starred_entries'], 'write', 'Star Entries', 'Star entry IDs.'],
        'starred_entries_delete' => ['DELETE', '/starred_entries.json', ['starred_entries'], 'write', 'Unstar Entries', 'Unstar entry IDs.'],
        'starred_entries_delete_post' => ['POST', '/starred_entries/delete.json', ['starred_entries'], 'write', 'Unstar Entries POST', 'POST fallback for unstarring.'],
        'taggings_list' => ['GET', '/taggings.json', [], 'read', 'List Taggings', 'List taggings.'],
        'taggings_get' => ['GET', '/taggings/{tagging_id}.json', ['tagging_id'], 'read', 'Get Tagging', 'Get one tagging.'],
        'taggings_create' => ['POST', '/taggings.json', ['feed_id', 'name'], 'write', 'Create Tagging', 'Create a tagging for a feed.'],
        'taggings_delete' => ['DELETE', '/taggings/{tagging_id}.json', ['tagging_id'], 'write', 'Delete Tagging', 'Delete one tagging.'],
        'tags_create' => ['POST', '/tags.json', ['old_name', 'new_name'], 'write', 'Rename Tag', 'Rename a tag.'],
        'tags_delete' => ['DELETE', '/tags.json', ['name'], 'write', 'Delete Tag', 'Delete a tag.'],
        'saved_searches_list' => ['GET', '/saved_searches.json', [], 'read', 'List Saved Searches', 'List saved searches.'],
        'saved_searches_get' => ['GET', '/saved_searches/{saved_search_id}.json', ['saved_search_id'], 'read', 'Get Saved Search', 'Get matching entry IDs or entries for a saved search.'],
        'saved_searches_create' => ['POST', '/saved_searches.json', ['name', 'query'], 'write', 'Create Saved Search', 'Create a saved search.'],
        'saved_searches_update' => ['PATCH', '/saved_searches/{saved_search_id}.json', ['saved_search_id'], 'write', 'Update Saved Search', 'Update a saved search.'],
        'saved_searches_update_post' => ['POST', '/saved_searches/{saved_search_id}/update.json', ['saved_search_id'], 'write', 'Update Saved Search POST', 'POST fallback for saved-search updates.'],
        'saved_searches_delete' => ['DELETE', '/saved_searches/{saved_search_id}.json', ['saved_search_id'], 'write', 'Delete Saved Search', 'Delete a saved search.'],
        'recently_read_entries_list' => ['GET', '/recently_read_entries.json', [], 'read', 'List Recently Read Entry IDs', 'List recently read entry IDs.'],
        'recently_read_entries_create' => ['POST', '/recently_read_entries.json', ['recently_read_entries'], 'write', 'Create Recently Read Entries', 'Create recently-read records.'],
        'updated_entries_list' => ['GET', '/updated_entries.json', [], 'read', 'List Updated Entry IDs', 'List updated entry IDs.'],
        'updated_entries_delete' => ['DELETE', '/updated_entries.json', ['updated_entries'], 'write', 'Clear Updated Entries', 'Mark updated entries as read.'],
        'updated_entries_delete_post' => ['POST', '/updated_entries/delete.json', ['updated_entries'], 'write', 'Clear Updated Entries POST', 'POST fallback for clearing updated entries.'],
        'icons_list' => ['GET', '/icons.json', [], 'read', 'List Icons', 'List feed icons.'],
        'imports_create' => ['POST', '/imports.json', ['opml'], 'write', 'Create Import', 'Import OPML XML subscriptions.'],
        'imports_list' => ['GET', '/imports.json', [], 'read', 'List Imports', 'List imports.'],
        'imports_get' => ['GET', '/imports/{import_id}.json', ['import_id'], 'read', 'Get Import', 'Get import status.'],
        'pages_create' => ['POST', '/pages.json', ['url'], 'write', 'Create Page', 'Save a page to Feedbin.'],
        'pages_delete' => ['DELETE', '/pages/{page_id}.json', ['page_id'], 'write', 'Delete Page', 'Delete a saved page.'],
    ];

    /**
     * @param  string  $username  Feedbin account email.
     * @param  string  $password  Feedbin password.
     * @param  string  $baseUrl  Feedbin API base URL.
     */
    public function __construct(
        private string $username = '',
        private string $password = '',
        private string $baseUrl = self::DEFAULT_BASE_URL,
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: self::DEFAULT_BASE_URL, '/');
    }

    /**
     * Check whether Basic auth credentials are available.
     */
    public function isConfigured(): bool
    {
        return trim($this->username) !== '' && trim($this->password) !== '' && trim($this->baseUrl) !== '';
    }

    /**
     * Return the documented Feedbin operation map.
     *
     * @return array<string, array{0: string, 1: string, 2: array<int, string>, 3: string, 4: string, 5: string}>
     */
    public static function operations(): array
    {
        return self::OPERATIONS;
    }

    /**
     * Call a documented Feedbin operation.
     *
     * @param  string  $operation  Operation key from operations().
     * @param  array<string, mixed>  $params  Path, query, or JSON body fields.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $params = []): array
    {
        $definition = self::OPERATIONS[$operation] ?? null;
        if ($definition === null) {
            throw new RuntimeException("Unsupported Feedbin operation: {$operation}");
        }

        [$method, $path, $required] = $definition;
        foreach ($required as $field) {
            if (($params[$field] ?? '') === '') {
                throw new RuntimeException($field.' is required.');
            }
        }

        return $this->request($method, $this->interpolatePath($path, $params), $params, $operation === 'imports_create');
    }

    /**
     * Execute a safe raw GET request.
     *
     * @param  string  $path  Relative Feedbin API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array { return $this->request('GET', $this->normalizePath($path), $query); }

    /**
     * Execute a safe raw POST request.
     *
     * @param  string  $path  Relative Feedbin API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array { return $this->request('POST', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw PATCH request.
     *
     * @param  string  $path  Relative Feedbin API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array { return $this->request('PATCH', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw DELETE request.
     *
     * @param  string  $path  Relative Feedbin API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array { return $this->request('DELETE', $this->normalizePath($path), $query); }

    /**
     * Dispatch an authenticated Feedbin request.
     *
     * @param  array<string, mixed>  $data  Query or body fields.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], bool $xml = false): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Feedbin username and password are required.');
        }

        $response = $this->rawRequest($method, $path, $data, $xml);
        if (!$response->successful() && !in_array($response->status(), [300, 302], true)) {
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
        $http = Http::withBasicAuth($this->username, $this->password)->acceptJson()->timeout(30);

        try {
            if ($xml) {
                return $http->withBody((string) $data['opml'], 'text/xml')->post($url);
            }

            return match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->asJson()->post($url, $data),
                'PATCH' => $http->asJson()->patch($url, $data),
                'DELETE' => $data === [] ? $http->delete($url) : $http->send('DELETE', $url, ['json' => $data]),
                default => throw new RuntimeException("Unsupported Feedbin method: {$method}"),
            };
        } catch (\Throwable $e) {
            Log::error("Feedbin API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Feedbin API: '.$e->getMessage());
        }
    }

    /**
     * Throw a normalized Feedbin API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json) ? (string) ($json['error'] ?? $json['message'] ?? '') : trim($response->body());

        Log::error("Feedbin API error: {$method} {$path}", ['status' => $response->status(), 'body' => $response->body()]);

        throw new RuntimeException('Feedbin API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode JSON, text, or empty Feedbin responses.
     *
     * @return array<string, mixed>
     */
    private function decodeResponse(Response $response): array
    {
        $body = trim($response->body());
        $base = [
            'status' => $response->status(),
            'location' => $response->header('Location'),
            'record_count' => $response->header('X-Feedbin-Record-Count'),
            'links' => $response->header('Link') ?? $response->header('Links'),
        ];

        if ($body === '') {
            return array_filter(array_merge($base, ['success' => true]), static fn ($value): bool => $value !== null);
        }

        $json = $response->json();
        if (is_array($json)) {
            return array_filter(array_merge($base, ['data' => $json]), static fn ($value): bool => $value !== null);
        }

        return array_filter(array_merge($base, ['value' => $body]), static fn ($value): bool => $value !== null);
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
            throw new RuntimeException('Feedbin API path must be a non-empty relative path.');
        }

        return '/'.ltrim($path, '/');
    }
}
