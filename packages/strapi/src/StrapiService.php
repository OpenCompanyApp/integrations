<?php

namespace OpenCompany\Integrations\Strapi;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StrapiService
{
    /**
     * Create a new Strapi service instance.
     *
     * @param  string  $apiToken  The API token for Bearer authentication.
     * @param  string  $baseUrl   The base URL of the Strapi instance (without /api).
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://localhost:1337',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API token.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiToken);
    }

    /**
     * List entries for a given content type.
     *
     * @param  string  $contentType  The content type API ID (e.g., "article", "page").
     * @param  array   $params       Query parameters (pagination, sort, populate, filters, etc.).
     * @return array The parsed JSON response.
     */
    public function listEntries(string $contentType, array $params = []): array
    {
        return $this->request('GET', "/api/{$contentType}", $params);
    }

    /**
     * Get a single entry by ID.
     *
     * @param  string     $contentType  The content type API ID.
     * @param  int|string $id           The entry ID.
     * @param  array      $params       Query parameters (populate, fields, etc.).
     * @return array The parsed JSON response.
     */
    public function getEntry(string $contentType, int|string $id, array $params = []): array
    {
        return $this->request('GET', "/api/{$contentType}/{$id}", $params);
    }

    /**
     * Create a new entry.
     *
     * The data is automatically wrapped in a `{ "data": {...} }` envelope.
     *
     * @param  string  $contentType  The content type API ID.
     * @param  array   $data         The entry attributes.
     * @return array The parsed JSON response.
     */
    public function createEntry(string $contentType, array $data): array
    {
        return $this->request('POST', "/api/{$contentType}", [], ['data' => $data]);
    }

    /**
     * Update an existing entry.
     *
     * The data is automatically wrapped in a `{ "data": {...} }` envelope.
     *
     * @param  string     $contentType  The content type API ID.
     * @param  int|string $id           The entry ID.
     * @param  array      $data         The entry attributes to update.
     * @return array The parsed JSON response.
     */
    public function updateEntry(string $contentType, int|string $id, array $data): array
    {
        return $this->request('PUT', "/api/{$contentType}/{$id}", [], ['data' => $data]);
    }

    /**
     * Delete an entry by ID.
     *
     * @param  string     $contentType  The content type API ID.
     * @param  int|string $id           The entry ID.
     * @return array The parsed JSON response.
     */
    public function deleteEntry(string $contentType, int|string $id): array
    {
        return $this->request('DELETE', "/api/{$contentType}/{$id}");
    }

    /**
     * List all content types from the Content-Type Builder.
     *
     * Uses the admin endpoint: GET /content-type-builder/content-types.
     *
     * @return array The parsed JSON response.
     */
    public function listContentTypes(): array
    {
        return $this->request('GET', '/content-type-builder/content-types');
    }

    /**
     * Get the currently authenticated user.
     *
     * Uses the admin endpoint: GET /users/me.
     *
     * @return array The parsed JSON response.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return the parsed JSON response.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    The API path (e.g., "/api/articles").
     * @param  array   $query   Query string parameters.
     * @param  array   $body    JSON body parameters.
     * @return array The parsed JSON response.
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Strapi API.
     *
     * @param  string  $method  The HTTP method.
     * @param  string  $path    The API path.
     * @param  array   $query   Query parameters.
     * @param  array   $body    JSON body.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException On connection failure or API error.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if (! $this->apiToken) {
            throw new \RuntimeException('Strapi API token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $query),
                'POST'   => $http->post($url, array_merge($query, $body)),
                'PUT'    => $http->put($url, array_merge($query, $body)),
                'DELETE' => $http->delete($url, $query),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $contentType = $response->header('Content-Type');
                $responseBody = $response->body();

                if (str_contains((string) $contentType, 'text/html') || str_starts_with(trim($responseBody), '<!DOCTYPE')) {
                    Log::warning("Strapi API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Strapi API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $responseBody;
                Log::error("Strapi API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Strapi API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Strapi API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Strapi API: {$e->getMessage()}");
        }
    }
}
