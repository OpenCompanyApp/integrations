<?php

namespace OpenCompany\Integrations\MongoDB;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MongoDBService
{
    public function __construct(
        private string $apiKey = '',
        private string $clusterUrl = '',
    ) {
        $this->clusterUrl = rtrim($this->clusterUrl, '/');
    }

    /**
     * Check whether the service has the required credentials configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->clusterUrl);
    }

    /**
     * Find documents in a collection.
     *
     * @param  string  $database    The database name.
     * @param  string  $collection  The collection name.
     * @param  array  $filter       MongoDB query filter.
     * @param  array  $options      Optional query options (projection, sort, limit, skip).
     * @return array<string, mixed>
     */
    public function find(string $database, string $collection, array $filter = [], array $options = []): array
    {
        $body = [
            'database' => $database,
            'collection' => $collection,
            'filter' => $filter,
        ];

        if (isset($options['projection'])) {
            $body['projection'] = $options['projection'];
        }
        if (isset($options['sort'])) {
            $body['sort'] = $options['sort'];
        }
        if (isset($options['limit'])) {
            $body['limit'] = (int) $options['limit'];
        }
        if (isset($options['skip'])) {
            $body['skip'] = (int) $options['skip'];
        }

        return $this->action('find', $body);
    }

    /**
     * Find a single document in a collection.
     *
     * @param  string  $database    The database name.
     * @param  string  $collection  The collection name.
     * @param  array  $filter       MongoDB query filter.
     * @param  array  $options      Optional query options (projection).
     * @return array<string, mixed>
     */
    public function findOne(string $database, string $collection, array $filter = [], array $options = []): array
    {
        $body = [
            'database' => $database,
            'collection' => $collection,
            'filter' => $filter,
        ];

        if (isset($options['projection'])) {
            $body['projection'] = $options['projection'];
        }

        return $this->action('findOne', $body);
    }

    /**
     * Insert a single document into a collection.
     *
     * @param  string  $database    The database name.
     * @param  string  $collection  The collection name.
     * @param  array  $document     The document to insert.
     * @return array<string, mixed>
     */
    public function insertOne(string $database, string $collection, array $document): array
    {
        return $this->action('insertOne', [
            'database' => $database,
            'collection' => $collection,
            'document' => $document,
        ]);
    }

    /**
     * Insert multiple documents into a collection.
     *
     * @param  string  $database    The database name.
     * @param  string  $collection  The collection name.
     * @param  array  $documents    The documents to insert.
     * @return array<string, mixed>
     */
    public function insertMany(string $database, string $collection, array $documents): array
    {
        return $this->action('insertMany', [
            'database' => $database,
            'collection' => $collection,
            'documents' => $documents,
        ]);
    }

    /**
     * Update a single document in a collection.
     *
     * @param  string  $database    The database name.
     * @param  string  $collection  The collection name.
     * @param  array  $filter       MongoDB query filter to match the document.
     * @param  array  $update       Update operations (e.g., ['$set' => ['field' => 'value']]).
     * @return array<string, mixed>
     */
    public function updateOne(string $database, string $collection, array $filter, array $update): array
    {
        return $this->action('updateOne', [
            'database' => $database,
            'collection' => $collection,
            'filter' => $filter,
            'update' => $update,
        ]);
    }

    /**
     * Delete a single document from a collection.
     *
     * @param  string  $database    The database name.
     * @param  string  $collection  The collection name.
     * @param  array  $filter       MongoDB query filter to match the document.
     * @return array<string, mixed>
     */
    public function deleteOne(string $database, string $collection, array $filter): array
    {
        return $this->action('deleteOne', [
            'database' => $database,
            'collection' => $collection,
            'filter' => $filter,
        ]);
    }

    /**
     * Run an aggregation pipeline on a collection.
     *
     * @param  string  $database    The database name.
     * @param  string  $collection  The collection name.
     * @param  array  $pipeline     The aggregation pipeline stages.
     * @return array<string, mixed>
     */
    public function aggregate(string $database, string $collection, array $pipeline): array
    {
        return $this->action('aggregate', [
            'database' => $database,
            'collection' => $collection,
            'pipeline' => $pipeline,
        ]);
    }

    /**
     * List collections in a database.
     *
     * @param  string  $database  The database name.
     * @return array<string, mixed>
     */
    public function listCollections(string $database): array
    {
        return $this->request('GET', "/api/atlas/v2/groups/{$database}/clusters");
    }

    /**
     * Get current user / heartbeat check.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/admin/heartbeat');
    }

    /**
     * Execute a Data API action.
     *
     * @param  string  $action  The action name (find, findOne, insertOne, etc.).
     * @param  array<string, mixed>  $body  The request body.
     * @return array<string, mixed>
     */
    private function action(string $action, array $body): array
    {
        return $this->request('POST', "/api/app/v1/{$action}", $body);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data  Request data or body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the MongoDB Atlas Data API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data  Request data or body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('MongoDB Atlas API key is not configured.');
        }

        if (!$this->clusterUrl) {
            throw new \RuntimeException('MongoDB Atlas cluster URL is not configured.');
        }

        $url = $this->clusterUrl . $path;

        try {
            $http = Http::withHeaders([
                'api-key' => $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
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
                    Log::warning("MongoDB Atlas API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("MongoDB Atlas API endpoint not available (HTTP {$response->status()}). Check your cluster URL and API key.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("MongoDB Atlas API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("MongoDB Atlas API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("MongoDB Atlas API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to MongoDB Atlas API: {$e->getMessage()}");
        }
    }
}
