<?php

namespace OpenCompany\Integrations\Contentful;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Contentful Content Management API covering content types, entries, assets, and space info.
 *
 * Wraps the Contentful CMA API and handles authentication, request routing,
 * and error reporting for a given space.
 */
class ContentfulService
{
    private string $baseUrl;

    /**
     * @param  string  $accessToken  Contentful Management API token (CPAT)
     * @param  string  $spaceId      Contentful space ID
     */
    public function __construct(
        private string $accessToken = '',
        private string $spaceId = '',
    ) {
        $this->baseUrl = "https://api.contentful.com/spaces/{$this->spaceId}";
    }

    /**
     * Check whether the service has sufficient credentials to make API calls.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->accessToken) && ! empty($this->spaceId);
    }

    // ── Space ──────────────────────────────────────────────

    /**
     * Get the current space.
     *
     * @return array<string, mixed>
     */
    public function getSpace(): array
    {
        return $this->request('GET', '/');
    }

    // ── Content Types ──────────────────────────────────────

    /**
     * List content types in the space.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. limit)
     * @return array<string, mixed>
     */
    public function listContentTypes(array $params = []): array
    {
        return $this->request('GET', '/content_types', $params);
    }

    /**
     * Get a single content type by ID.
     *
     * @return array<string, mixed>
     */
    public function getContentType(string $contentTypeId): array
    {
        return $this->request('GET', "/content_types/{$contentTypeId}");
    }

    /**
     * Create a new content type.
     *
     * @param  array<string, mixed>  $body  Content type definition (name, display_name, description, fields)
     * @return array<string, mixed>
     */
    public function createContentType(array $body): array
    {
        return $this->request('POST', '/content_types', $body);
    }

    // ── Entries ────────────────────────────────────────────

    /**
     * List entries in the space.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. content_type, limit, skip, order, query)
     * @return array<string, mixed>
     */
    public function listEntries(array $params = []): array
    {
        return $this->request('GET', '/entries', $params);
    }

    /**
     * Get a single entry by ID.
     *
     * @return array<string, mixed>
     */
    public function getEntry(string $entryId): array
    {
        return $this->request('GET', "/entries/{$entryId}");
    }

    /**
     * Create a new entry.
     *
     * @param  string  $contentTypeId  The content type ID for the entry
     * @param  array<string, mixed>  $body  Entry fields (localized)
     * @return array<string, mixed>
     */
    public function createEntry(string $contentTypeId, array $body): array
    {
        return $this->request('POST', '/entries', $body, [
            'X-Contentful-Content-Type' => $contentTypeId,
        ]);
    }

    /**
     * Update an existing entry.
     *
     * @param  string  $entryId  The entry ID
     * @param  int  $version  The current version for optimistic locking
     * @param  array<string, mixed>  $body  Updated entry fields (localized)
     * @return array<string, mixed>
     */
    public function updateEntry(string $entryId, int $version, array $body): array
    {
        return $this->request('PUT', "/entries/{$entryId}", $body, [
            'X-Contentful-Version' => (string) $version,
        ]);
    }

    /**
     * Publish an entry.
     *
     * @param  string  $entryId  The entry ID
     * @param  int  $version  The current version for optimistic locking
     * @return array<string, mixed>
     */
    public function publishEntry(string $entryId, int $version): array
    {
        return $this->request('PUT', "/entries/{$entryId}/published", [], [
            'X-Contentful-Version' => (string) $version,
        ]);
    }

    /**
     * Unpublish an entry.
     *
     * @param  string  $entryId  The entry ID
     * @param  int  $version  The current version for optimistic locking
     * @return array<string, mixed>
     */
    public function unpublishEntry(string $entryId, int $version): array
    {
        return $this->request('DELETE', "/entries/{$entryId}/published", [], [
            'X-Contentful-Version' => (string) $version,
        ]);
    }

    /**
     * Delete an entry.
     *
     * @return array<string, mixed>
     */
    public function deleteEntry(string $entryId): array
    {
        return $this->request('DELETE', "/entries/{$entryId}");
    }

    // ── Assets ─────────────────────────────────────────────

    /**
     * List assets in the space.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. limit, skip)
     * @return array<string, mixed>
     */
    public function listAssets(array $params = []): array
    {
        return $this->request('GET', '/assets', $params);
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request to the Contentful Management API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API path relative to the space base URL
     * @param  array<string, mixed>  $data  Query params (GET) or body data (POST/PUT)
     * @param  array<string, string>  $extraHeaders  Additional headers (e.g. X-Contentful-Version)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], array $extraHeaders = []): array
    {
        if (! $this->accessToken || ! $this->spaceId) {
            throw new \RuntimeException('Contentful access token and space ID are not configured.');
        }

        try {
            $headers = array_merge([
                'Authorization' => 'Bearer ' . $this->accessToken,
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
                $err = $body['message'] ?? $body['sys']['id'] ?? $response->body();

                Log::error("Contentful API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $err,
                ]);

                $msg = is_string($err) ? $err : json_encode($err);

                throw new \RuntimeException('Contentful API error (' . $response->status() . '): ' . $msg);
            }

            // DELETE may return 204 No Content
            if ($response->status() === 204) {
                return ['deleted' => true];
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Contentful API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Contentful API: {$e->getMessage()}");
        }
    }
}
