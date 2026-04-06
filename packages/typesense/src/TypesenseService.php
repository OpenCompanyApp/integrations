<?php

namespace OpenCompany\Integrations\Typesense;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TypesenseService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'http://localhost:8108',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Typesense service is configured (has an API key).
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List all collections in the Typesense instance.
     *
     * @return array The list of collections.
     */
    public function listCollections(): array
    {
        return $this->request('GET', '/collections');
    }

    /**
     * Get details of a specific collection by name.
     *
     * @param  string  $name  The name of the collection.
     * @return array The collection details.
     */
    public function getCollection(string $name): array
    {
        return $this->request('GET', '/collections/' . urlencode($name));
    }

    /**
     * Create a new collection with the given schema.
     *
     * @param  array  $schema  The collection schema (name, fields, default_sorting_field, etc.).
     * @return array The created collection details.
     */
    public function createCollection(array $schema): array
    {
        return $this->request('POST', '/collections', $schema);
    }

    /**
     * Search for documents in a collection.
     *
     * @param  string  $collection  The collection name to search in.
     * @param  array  $params  Search parameters (q, query_by, filter_by, sort_by, per_page, page, etc.).
     * @return array The search results.
     */
    public function searchDocuments(string $collection, array $params): array
    {
        return $this->request('GET', '/collections/' . urlencode($collection) . '/documents/search', $params);
    }

    /**
     * Index (create or update) a document in a collection.
     *
     * @param  string  $collection  The collection name.
     * @param  array  $document  The document data to index.
     * @return array The indexed document.
     */
    public function indexDocument(string $collection, array $document): array
    {
        return $this->request('POST', '/collections/' . urlencode($collection) . '/documents', $document);
    }

    /**
     * Get a single document by its ID from a collection.
     *
     * @param  string  $collection  The collection name.
     * @param  string  $id  The document ID.
     * @return array The document data.
     */
    public function getDocument(string $collection, string $id): array
    {
        return $this->request('GET', '/collections/' . urlencode($collection) . '/documents/' . urlencode($id));
    }

    /**
     * Check the health of the Typesense instance.
     *
     * @return array The health status.
     */
    public function getHealth(): array
    {
        return $this->request('GET', '/health');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array  $data  Query params (GET) or body data (POST/PUT).
     * @return array The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($path === '/health' && $response->status() === 200) {
            return $response->json() ?? ['ok' => true];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Typesense API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array  $data  Query params (GET) or body data (POST/PUT).
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException When the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Typesense API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'X-TYPESENSE-API-KEY' => $this->apiKey,
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
                $body = $response->body();
                $error = $response->json('message') ?? $body;

                Log::error("Typesense API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Typesense API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Typesense API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Typesense API: {$e->getMessage()}");
        }
    }
}
