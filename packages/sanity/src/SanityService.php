<?php

namespace OpenCompany\Integrations\Sanity;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SanityService
{
    private string $baseUrl;

    public function __construct(
        private string $apiToken = '',
        private string $projectId = '',
        private string $dataset = 'production',
    ) {
        $this->baseUrl = $this->buildBaseUrl();
    }

    /**
     * Check whether the service is configured with required credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiToken) && !empty($this->projectId);
    }

    /**
     * Query documents using GROQ (Graph-Relational Object Queries).
     *
     * @param  string  $query  GROQ query string
     * @param  array<string, mixed>  $params  Optional parameters referenced in the query as $paramName
     * @return array<string, mixed>
     */
    public function queryDocuments(string $query, array $params = []): array
    {
        $data = ['query' => $query];
        if (!empty($params)) {
            $data['params'] = $params;
        }

        return $this->request('POST', "/data/query/{$this->dataset}", $data);
    }

    /**
     * Get a single document by its ID.
     *
     * @param  string  $id  The document ID (e.g., "doc-123")
     * @return array<string, mixed>
     */
    public function getDocument(string $id): array
    {
        return $this->request('GET', "/data/doc/{$this->dataset}/" . urlencode($id));
    }

    /**
     * Create a new document in the dataset.
     *
     * @param  array<string, mixed>  $data  Document data including the required _type field
     * @return array<string, mixed>
     */
    public function createDocument(array $data): array
    {
        return $this->request('POST', "/data/mutate/{$this->dataset}", [
            'mutations' => [
                ['create' => $data],
            ],
        ]);
    }

    /**
     * Update an existing document by applying a patch.
     *
     * @param  string  $id  The document ID to update
     * @param  array<string, mixed>  $data  Fields to set on the document
     * @return array<string, mixed>
     */
    public function updateDocument(string $id, array $data): array
    {
        return $this->request('POST', "/data/mutate/{$this->dataset}", [
            'mutations' => [
                ['patch' => ['id' => $id, 'set' => $data]],
            ],
        ]);
    }

    /**
     * Delete a document by its ID.
     *
     * @param  string  $id  The document ID to delete
     * @return array<string, mixed>
     */
    public function deleteDocument(string $id): array
    {
        return $this->request('POST', "/data/mutate/{$this->dataset}", [
            'mutations' => [
                ['delete' => ['id' => $id]],
            ],
        ]);
    }

    /**
     * List all projects accessible to the authenticated user.
     *
     * @return array<string, mixed>
     */
    public function listProjects(): array
    {
        return $this->managementRequest('GET', '/projects');
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Build the base URL from the project ID.
     */
    private function buildBaseUrl(): string
    {
        if (empty($this->projectId)) {
            return 'https://api.sanity.io/v2023-10-01';
        }

        return "https://{$this->projectId}.api.sanity.io/v2023-10-01";
    }

    /**
     * Make an API request to the Sanity Content API and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API path (appended to base URL)
     * @param  array<string, mixed>  $data  Request body or query parameters
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($this->baseUrl . $path, $method, $data);

        return $response->json() ?? [];
    }

    /**
     * Make an API request to the Sanity Management API and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API path (appended to management base URL)
     * @param  array<string, mixed>  $data  Request body or query parameters
     * @return array<string, mixed>
     */
    private function managementRequest(string $method, string $path, array $data = []): array
    {
        $url = 'https://api.sanity.io/v2021-06-07' . $path;
        $response = $this->rawRequest($url, $method, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Sanity API.
     *
     * @param  string  $url  Full URL to request
     * @param  string  $method  HTTP method
     * @param  array<string, mixed>  $data  Request data
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $url, string $method, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiToken) {
            throw new \RuntimeException('Sanity API token is not configured.');
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
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
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();
                Log::error("Sanity API error: {$method} {$url}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Sanity API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Sanity API connection error: {$method} {$url}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Sanity API: {$e->getMessage()}");
        }
    }
}
