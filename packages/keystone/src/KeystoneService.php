<?php

namespace OpenCompany\Integrations\Keystone;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KeystoneService
{
    /**
     * Create a new KeystoneService instance.
     *
     * @param string $accessToken The KeystoneJS API bearer token.
     * @param string $baseUrl     The base URL of the KeystoneJS API (e.g. https://api.keystonejs.com/v1).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.keystonejs.com/v1',
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
     * List all available lists (collections) in the KeystoneJS instance.
     *
     * @return array The parsed JSON response containing the lists.
     */
    public function listLists(): array
    {
        return $this->request('GET', '/lists');
    }

    /**
     * Get metadata and schema for a specific list.
     *
     * @param  string $listKey The list key (e.g. "posts", "users").
     * @return array  The parsed JSON response containing the list metadata.
     */
    public function getList(string $listKey): array
    {
        return $this->request('GET', '/lists/' . urlencode($listKey));
    }

    /**
     * List items in a list with optional filtering, sorting, and pagination.
     *
     * @param  string $listKey The list key (e.g. "posts", "users").
     * @param  array  $params  Query parameters: where, orderBy, take, skip, search, fields.
     * @return array  The parsed JSON response containing items.
     */
    public function listItems(string $listKey, array $params = []): array
    {
        return $this->request('GET', '/lists/' . urlencode($listKey) . '/items', $params);
    }

    /**
     * Get a single item by its ID.
     *
     * @param  string     $listKey The list key.
     * @param  int|string $id      The item ID.
     * @param  array      $params  Query parameters: fields.
     * @return array  The parsed JSON response containing the item.
     */
    public function getItem(string $listKey, int|string $id, array $params = []): array
    {
        return $this->request('GET', '/lists/' . urlencode($listKey) . '/items/' . urlencode((string) $id), $params);
    }

    /**
     * Create a new item in a list.
     *
     * @param  string $listKey The list key.
     * @param  array  $data    The item fields to create.
     * @return array  The parsed JSON response containing the created item.
     */
    public function createItem(string $listKey, array $data): array
    {
        return $this->request('POST', '/lists/' . urlencode($listKey) . '/items', $data);
    }

    /**
     * List users in the KeystoneJS instance.
     *
     * @param  array $params Query parameters: where, orderBy, take, skip, search, fields.
     * @return array The parsed JSON response containing users.
     */
    public function listUsers(array $params = []): array
    {
        return $this->request('GET', '/users', $params);
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
     * @param  string $path   The API path (e.g. "/lists/posts/items").
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
     * Make a raw HTTP request to the KeystoneJS REST API.
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
            throw new \RuntimeException('Keystone access token is not configured.');
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

                Log::error("Keystone API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $error,
                ]);

                throw new \RuntimeException(
                    "Keystone API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Keystone API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Keystone API: {$e->getMessage()}");
        }
    }
}
