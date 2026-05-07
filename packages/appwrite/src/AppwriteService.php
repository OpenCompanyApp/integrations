<?php

namespace OpenCompany\Integrations\Appwrite;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Appwrite server REST API.
 *
 * Handles project API-key authentication, safe path construction, error
 * parsing, and the small convenience wrappers used by the Appwrite tools.
 */
class AppwriteService
{
    /**
     * Create a new Appwrite service instance.
     *
     * @param  string  $apiKey  The Appwrite API key.
     * @param  string  $projectId  The Appwrite project ID.
     * @param  string  $baseUrl  The Appwrite server REST base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $projectId = '',
        private string $baseUrl = 'https://cloud.appwrite.io/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured.
     *
     * @return bool True if the API key and project ID are set.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->projectId);
    }

    /**
     * List all databases in the project.
     *
     * @param  array<string, mixed>  $params  Query parameters such as queries, search, and total.
     * @return array<string, mixed>
     */
    public function listDatabases(array $params = []): array
    {
        return $this->request('GET', '/databases', $params);
    }

    /**
     * Get a database by its ID.
     *
     * @return array<string, mixed>
     */
    public function getDatabase(string $id): array
    {
        return $this->request('GET', '/databases/' . urlencode($id));
    }

    /**
     * List collections in a database.
     *
     * @param  array<string, mixed>  $params  Query parameters such as queries, search, and total.
     * @return array<string, mixed>
     */
    public function listCollections(string $databaseId, array $params = []): array
    {
        return $this->request('GET', '/databases/' . urlencode($databaseId) . '/collections', $params);
    }

    /**
     * List documents in a collection.
     *
     * @param  array<string, mixed>  $params  Query parameters such as queries and total.
     * @return array<string, mixed>
     */
    public function listDocuments(string $databaseId, string $collectionId, array $params = []): array
    {
        return $this->request('GET', '/databases/' . urlencode($databaseId) . '/collections/' . urlencode($collectionId) . '/documents', $params);
    }

    /**
     * Get a single document by its ID.
     *
     * @return array<string, mixed>
     */
    public function getDocument(string $databaseId, string $collectionId, string $docId): array
    {
        return $this->request('GET', '/databases/' . urlencode($databaseId) . '/collections/' . urlencode($collectionId) . '/documents/' . urlencode($docId));
    }

    /**
     * Create a new document in a collection.
     *
     * @param  array<string, mixed>  $data  Request body including documentId, data, and permissions.
     * @return array<string, mixed>
     */
    public function createDocument(string $databaseId, string $collectionId, array $data): array
    {
        return $this->request('POST', '/databases/' . urlencode($databaseId) . '/collections/' . urlencode($collectionId) . '/documents', body: $data);
    }

    /**
     * Get the currently authenticated user account.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/account');
    }

    /**
     * Make a generic GET request to the Appwrite API.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, query: $query);
    }

    /**
     * Make a generic POST request to the Appwrite API.
     *
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = [], array $query = []): array
    {
        return $this->request('POST', $path, query: $query, body: $body);
    }

    /**
     * Make a generic PUT request to the Appwrite API.
     *
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $body = [], array $query = []): array
    {
        return $this->request('PUT', $path, query: $query, body: $body);
    }

    /**
     * Make a generic PATCH request to the Appwrite API.
     *
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $body = [], array $query = []): array
    {
        return $this->request('PATCH', $path, query: $query, body: $body);
    }

    /**
     * Make a generic DELETE request to the Appwrite API.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $path, query: $query);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Appwrite API.
     *
     * @param  string  $method  The HTTP method.
     * @param  string  $path  The API endpoint path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws RuntimeException If credentials are missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new RuntimeException('Appwrite API key is not configured.');
        }

        if (!$this->projectId) {
            throw new RuntimeException('Appwrite project ID is not configured.');
        }

        $url = $this->buildUrl($path, $query);

        try {
            $http = Http::withHeaders([
                'X-Appwrite-Key' => $this->apiKey,
                'X-Appwrite-Project' => $this->projectId,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'PATCH' => $http->patch($url, $body),
                'DELETE' => $http->delete($url, $body),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $json = $response->json();
                $error = $json['message'] ?? $response->body();

                Log::error("Appwrite API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException("Appwrite API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Appwrite API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Appwrite API: {$e->getMessage()}");
        }
    }

    /**
     * Build a safe Appwrite API URL.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function buildUrl(string $path, array $query = []): string
    {
        if (preg_match('/^https?:\/\//i', $path) === 1 || str_contains($path, '..')) {
            throw new RuntimeException('Appwrite API path must be a safe relative path.');
        }

        $queryString = $this->buildQuery($query);

        return $this->baseUrl.'/'.ltrim($path, '/').($queryString !== '' ? '?'.$queryString : '');
    }

    /**
     * Build an Appwrite query string with repeated array values.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function buildQuery(array $query): string
    {
        $pairs = [];

        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }

            if (is_array($value)) {
                foreach ($value as $item) {
                    $queryKey = str_ends_with((string) $key, '[]') ? (string) $key : (string) $key.'[]';
                    $pairs[] = rawurlencode($queryKey).'='.rawurlencode(is_scalar($item) ? (string) $item : json_encode($item, JSON_THROW_ON_ERROR));
                }
                continue;
            }

            $pairs[] = rawurlencode((string) $key).'='.rawurlencode((string) $value);
        }

        return implode('&', $pairs);
    }
}
