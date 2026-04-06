<?php

namespace OpenCompany\Integrations\Directus;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DirectusService
{
    /**
     * Create a new DirectusService instance.
     *
     * @param string $accessToken The Directus API bearer token.
     * @param string $baseUrl     The base URL of the Directus instance (e.g. https://your-directus.com).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://directus.example.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has an access token configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List items in a collection with optional filtering, sorting, and pagination.
     *
     * @param  string $collection The collection name (e.g. "articles").
     * @param  array  $params     Query parameters: limit, offset, sort, filter, fields, meta, search, page.
     * @return array  The parsed JSON response containing a "data" array.
     */
    public function listItems(string $collection, array $params = []): array
    {
        return $this->request('GET', "/items/{$collection}", $params);
    }

    /**
     * Get a single item by its primary key.
     *
     * @param  string $collection The collection name.
     * @param  int|string $id     The item primary key.
     * @param  array  $params     Query parameters: fields.
     * @return array  The parsed JSON response containing the item data.
     */
    public function getItem(string $collection, int|string $id, array $params = []): array
    {
        return $this->request('GET', "/items/{$collection}/{$id}", $params);
    }

    /**
     * Create a new item in a collection.
     *
     * @param  string $collection The collection name.
     * @param  array  $data       The item fields to create.
     * @return array  The parsed JSON response containing the created item.
     */
    public function createItem(string $collection, array $data): array
    {
        return $this->request('POST', "/items/{$collection}", $data);
    }

    /**
     * Update an existing item by its primary key.
     *
     * @param  string     $collection The collection name.
     * @param  int|string $id         The item primary key.
     * @param  array      $data       The fields to update.
     * @return array  The parsed JSON response containing the updated item.
     */
    public function updateItem(string $collection, int|string $id, array $data): array
    {
        return $this->request('PATCH', "/items/{$collection}/{$id}", $data);
    }

    /**
     * Delete an item by its primary key.
     *
     * @param  string     $collection The collection name.
     * @param  int|string $id         The item primary key.
     * @return array  Empty array on success.
     */
    public function deleteItem(string $collection, int|string $id): array
    {
        $this->request('DELETE', "/items/{$collection}/{$id}");

        return [];
    }

    /**
     * List all available collections in the Directus instance.
     *
     * @return array The parsed JSON response containing the collections list.
     */
    public function listCollections(): array
    {
        return $this->request('GET', '/collections');
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array The parsed JSON response containing the user data.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string $method The HTTP method (GET, POST, PATCH, DELETE).
     * @param  string $path   The API path (e.g. "/items/articles").
     * @param  array  $data   Query params (GET) or body data (POST/PATCH/DELETE).
     * @return array  The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Directus REST API.
     *
     * @param  string $method The HTTP method.
     * @param  string $path   The API path.
     * @param  array  $data   Query params or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On connection or API errors.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Directus access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PATCH'  => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $body = $response->body();
                $error = $response->json('errors.0.message')
                    ?? $response->json('error')
                    ?? $body;

                Log::error("Directus API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $error,
                ]);

                throw new \RuntimeException(
                    "Directus API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Directus API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Directus API: {$e->getMessage()}");
        }
    }
}
