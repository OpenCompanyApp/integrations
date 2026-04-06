<?php

namespace OpenCompany\Integrations\Weaviate;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeaviateService
{
    /**
     * Create a new Weaviate service instance.
     *
     * @param  string  $apiKey  The Bearer token or API key for authentication.
     * @param  string  $baseUrl  The base URL of the Weaviate instance (default: http://localhost:8080/v1).
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'http://localhost:8080/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List all schemas (collections) in the Weaviate instance.
     *
     * @return array<string, mixed> The list of schemas.
     */
    public function listSchemas(): array
    {
        return $this->request('GET', '/schema');
    }

    /**
     * Get the schema definition for a specific class.
     *
     * @param  string  $className  The name of the class/collection.
     * @return array<string, mixed> The schema definition.
     */
    public function getSchema(string $className): array
    {
        return $this->request('GET', '/schema/' . urlencode($className));
    }

    /**
     * Create a new class (collection) in the schema.
     *
     * @param  array<string, mixed>  $classDefinition  The class definition including 'class' name and 'properties' array.
     * @return array<string, mixed> The created class definition.
     */
    public function createClass(array $classDefinition): array
    {
        return $this->request('POST', '/schema', $classDefinition);
    }

    /**
     * Execute a GraphQL query against the Weaviate instance.
     *
     * @param  string  $query  The GraphQL query string.
     * @return array<string, mixed> The GraphQL response data.
     */
    public function graphql(string $query): array
    {
        return $this->request('POST', '/graphql', [
            'query' => $query,
        ]);
    }

    /**
     * Create a new data object in Weaviate.
     *
     * @param  string  $className  The class/collection name.
     * @param  array<string, mixed>  $properties  The object properties.
     * @param  string|null  $id  Optional UUID for the object.
     * @return array<string, mixed> The created object.
     */
    public function createObject(string $className, array $properties, ?string $id = null): array
    {
        $body = [
            'class' => $className,
            'properties' => $properties,
        ];

        if ($id !== null) {
            $body['id'] = $id;
        }

        return $this->request('POST', '/objects', $body);
    }

    /**
     * Get a data object from Weaviate by class name and ID.
     *
     * @param  string  $className  The class/collection name.
     * @param  string  $id  The UUID of the object.
     * @return array<string, mixed> The object data.
     */
    public function getObject(string $className, string $id): array
    {
        return $this->request('GET', '/objects/' . urlencode($className) . '/' . urlencode($id));
    }

    /**
     * Check the liveness of the Weaviate instance.
     *
     * @return array<string, mixed> The health check response.
     */
    public function getHealth(): array
    {
        return $this->request('GET', '/.well-known/live');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  The API path (appended to base URL).
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return array<string, mixed> The parsed JSON response.
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
     * Make a raw HTTP request to the Weaviate API.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  The API path (appended to base URL).
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(30);

            if ($this->apiKey) {
                $http = $http->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                ]);
            }

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

                if (str_contains((string) $contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Weaviate API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Weaviate API endpoint not available (HTTP {$response->status()}). Check the URL.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Weaviate API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Weaviate API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Weaviate API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Weaviate API: {$e->getMessage()}");
        }
    }
}
