<?php

namespace OpenCompany\Integrations\Appwrite;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AppwriteService
{
    /**
     * Create a new Appwrite service instance.
     *
     * @param string $apiKey    The Appwrite API key (used as X-Appwrite-Key header).
     * @param string $projectId The Appwrite project ID (used as X-Appwrite-Project header).
     * @param string $baseUrl   The Appwrite server base URL.
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
     * @param  array $params Query parameters: limit, offset, search.
     * @return array The parsed JSON response containing databases.
     */
    public function listDatabases(array $params = []): array
    {
        return $this->request('GET', '/databases', $params);
    }

    /**
     * Get a database by its ID.
     *
     * @param  string $id The database ID.
     * @return array The parsed JSON response containing the database.
     */
    public function getDatabase(string $id): array
    {
        return $this->request('GET', '/databases/' . urlencode($id));
    }

    /**
     * List collections in a database.
     *
     * @param  string $databaseId The database ID.
     * @param  array  $params     Query parameters: limit, offset.
     * @return array The parsed JSON response containing collections.
     */
    public function listCollections(string $databaseId, array $params = []): array
    {
        return $this->request('GET', '/databases/' . urlencode($databaseId) . '/collections', $params);
    }

    /**
     * List documents in a collection.
     *
     * @param  string $databaseId   The database ID.
     * @param  string $collectionId The collection ID.
     * @param  array  $params       Query parameters: limit, offset.
     * @return array The parsed JSON response containing documents.
     */
    public function listDocuments(string $databaseId, string $collectionId, array $params = []): array
    {
        return $this->request('GET', '/databases/' . urlencode($databaseId) . '/collections/' . urlencode($collectionId) . '/documents', $params);
    }

    /**
     * Get a single document by its ID.
     *
     * @param  string $databaseId   The database ID.
     * @param  string $collectionId The collection ID.
     * @param  string $docId        The document ID.
     * @return array The parsed JSON response containing the document.
     */
    public function getDocument(string $databaseId, string $collectionId, string $docId): array
    {
        return $this->request('GET', '/databases/' . urlencode($databaseId) . '/collections/' . urlencode($collectionId) . '/documents/' . urlencode($docId));
    }

    /**
     * Create a new document in a collection.
     *
     * @param  string $databaseId   The database ID.
     * @param  string $collectionId The collection ID.
     * @param  array  $data         The document data including documentId and data fields.
     * @return array The parsed JSON response containing the created document.
     */
    public function createDocument(string $databaseId, string $collectionId, array $data): array
    {
        return $this->request('POST', '/databases/' . urlencode($databaseId) . '/collections/' . urlencode($collectionId) . '/documents', $data);
    }

    /**
     * Get the currently authenticated user account.
     *
     * @return array The parsed JSON response containing the user account.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/account');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string $method The HTTP method (GET, POST, PUT, DELETE).
     * @param  string $path   The API endpoint path.
     * @param  array  $data   Request data (query params for GET, body for POST/PUT).
     * @return array The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Appwrite API.
     *
     * @param  string $method The HTTP method (GET, POST, PUT, DELETE).
     * @param  string $path   The API endpoint path.
     * @param  array  $data   Request data (query params for GET, body for POST/PUT).
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Appwrite API key is not configured.');
        }

        if (!$this->projectId) {
            throw new \RuntimeException('Appwrite project ID is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'X-Appwrite-Key' => $this->apiKey,
                'X-Appwrite-Project' => $this->projectId,
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
                $json = $response->json();
                $error = $json['message'] ?? $response->body();

                Log::error("Appwrite API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Appwrite API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Appwrite API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Appwrite API: {$e->getMessage()}");
        }
    }
}
