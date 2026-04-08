<?php

namespace OpenCompany\Integrations\Webflow;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebflowService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.webflow.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all sites the authenticated user has access to.
     *
     * @return array<string, mixed>
     */
    public function listSites(): array
    {
        return $this->request('GET', '/v2/sites');
    }

    /**
     * Get details for a specific site.
     *
     * @return array<string, mixed>
     */
    public function getSite(string $siteId): array
    {
        return $this->request('GET', '/v2/sites/' . urlencode($siteId));
    }

    /**
     * List collections for a site.
     *
     * @return array<string, mixed>
     */
    public function listCollections(string $siteId, int $limit = 100, int $offset = 0): array
    {
        return $this->request('GET', '/v2/sites/' . urlencode($siteId) . '/collections', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * List items in a collection.
     *
     * @return array<string, mixed>
     */
    public function listItems(string $collectionId, int $limit = 100, int $offset = 0): array
    {
        return $this->request('GET', '/v2/collections/' . urlencode($collectionId) . '/items', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get a single item from a collection.
     *
     * @return array<string, mixed>
     */
    public function getItem(string $collectionId, string $itemId): array
    {
        return $this->request('GET', '/v2/collections/' . urlencode($collectionId) . '/items/' . urlencode($itemId));
    }

    /**
     * Create a new item in a collection.
     *
     * @param  array<string, mixed>  $fields  Field data for the item.
     * @param  bool  $live  Whether to publish the item immediately.
     * @return array<string, mixed>
     */
    public function createItem(string $collectionId, array $fields, bool $live = false): array
    {
        $query = $live ? ['live' => 'true'] : [];

        return $this->request('POST', '/v2/collections/' . urlencode($collectionId) . '/items', [
            'fieldData' => $fields,
        ], $query);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v2/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Body/query data.
     * @param  array<string, string>  $query  Additional query parameters appended to the URL.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], array $query = []): array
    {
        $response = $this->rawRequest($method, $path, $data, $query);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Webflow API.
     *
     * @param  array<string, mixed>  $data  Body or query data depending on method.
     * @param  array<string, string>  $query  Additional query parameters appended to the URL.
     */
    private function rawRequest(string $method, string $path, array $data = [], array $query = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Webflow access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        if (!empty($query)) {
            $url .= '?' . http_build_query($query);
        }

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
                    Log::warning("Webflow API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Webflow API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is unavailable.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("Webflow API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Webflow API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Webflow API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Webflow API: {$e->getMessage()}");
        }
    }
}
