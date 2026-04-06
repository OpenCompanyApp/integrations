<?php

namespace OpenCompany\Integrations\Raindrop;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RaindropService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.raindrop.io/rest/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Get the currently authenticated user.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * List bookmarks (raindrops) with optional filters.
     *
     * @param  int|null  $collectionId  Collection ID to filter by (0 = all, -1 = unsorted, -99 = trash)
     * @param  string|null  $search  Search query
     * @param  int  $page  Page number (starts at 1)
     * @param  int  $perPage  Results per page (max 50)
     */
    public function listBookmarks(?int $collectionId = null, ?string $search = null, int $page = 1, int $perPage = 25): array
    {
        $params = [
            'page' => $page,
            'perpage' => min($perPage, 50),
        ];

        if ($collectionId !== null) {
            $params['collection_id'] = $collectionId;
        }

        if ($search !== null) {
            $params['search'] = $search;
        }

        return $this->request('GET', '/raindrops', $params);
    }

    /**
     * Get a single bookmark by ID.
     */
    public function getBookmark(int $id): array
    {
        return $this->request('GET', '/raindrop/' . $id);
    }

    /**
     * Create a new bookmark.
     *
     * @param  string  $link  The URL to bookmark
     * @param  string|null  $title  Optional title override
     * @param  array  $tags  Optional tags
     * @param  int|null  $collectionId  Target collection ID (0 = unsorted)
     * @param  string|null  $excerpt  Optional description/excerpt
     */
    public function createBookmark(string $link, ?string $title = null, array $tags = [], ?int $collectionId = null, ?string $excerpt = null): array
    {
        $data = ['link' => $link];

        if ($title !== null) {
            $data['title'] = $title;
        }

        if (!empty($tags)) {
            $data['tags'] = $tags;
        }

        if ($collectionId !== null) {
            $data['collection'] = ['$id' => $collectionId];
        }

        if ($excerpt !== null) {
            $data['excerpt'] = $excerpt;
        }

        return $this->request('POST', '/raindrops', $data);
    }

    /**
     * Update an existing bookmark.
     *
     * @param  int  $id  The bookmark ID
     * @param  array  $data  Fields to update (link, title, tags, collection, excerpt, etc.)
     */
    public function updateBookmark(int $id, array $data): array
    {
        return $this->request('PUT', '/raindrop/' . $id, $data);
    }

    /**
     * List all collections (root level).
     */
    public function listCollections(): array
    {
        return $this->request('GET', '/collections');
    }

    /**
     * Get a single collection by ID.
     */
    public function getCollection(int $id): array
    {
        return $this->request('GET', '/collection/' . $id);
    }

    /**
     * Make an API request and return parsed JSON.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Raindrop.io API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Raindrop.io access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Raindrop API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Raindrop API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('errorMessage') ?? $response->json('error') ?? $body;
                Log::error("Raindrop API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Raindrop API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Raindrop API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Raindrop API: {$e->getMessage()}");
        }
    }
}
