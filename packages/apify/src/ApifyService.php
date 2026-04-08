<?php

namespace OpenCompany\Integrations\Apify;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApifyService
{
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://api.apify.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Apify integration is configured (has an API token).
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiToken);
    }

    /**
     * Run an Apify actor.
     *
     * @param  string  $actorId  Actor ID (e.g. "apify/web-scraper" or numeric ID).
     * @param  array  $input  Input payload for the actor run.
     * @param  array  $options  Optional run options (build, waitForFinish, etc.).
     * @return array The created run resource.
     */
    public function runActor(string $actorId, array $input = [], array $options = []): array
    {
        $queryParams = [];
        if (isset($options['waitForFinish'])) {
            $queryParams['waitForFinish'] = $options['waitForFinish'];
        }
        if (isset($options['build'])) {
            $queryParams['build'] = $options['build'];
        }
        if (isset($options['timeout'])) {
            $queryParams['timeout'] = $options['timeout'];
        }
        if (isset($options['memory'])) {
            $queryParams['memory'] = $options['memory'];
        }

        return $this->request('POST', '/acts/' . urlencode($actorId) . '/runs', $input, $queryParams);
    }

    /**
     * Get details of an actor run.
     *
     * @param  string  $runId  The run ID.
     * @return array The run resource.
     */
    public function getRun(string $runId): array
    {
        return $this->request('GET', '/actor-runs/' . urlencode($runId));
    }

    /**
     * List available actors.
     *
     * @param  int  $offset  Number of actors to skip.
     * @param  int  $limit  Maximum number of actors to return.
     * @return array List of actor resources.
     */
    public function listActors(int $offset = 0, int $limit = 20): array
    {
        return $this->request('GET', '/acts', [], [
            'offset' => $offset,
            'limit' => $limit,
        ]);
    }

    /**
     * Get details of a specific actor.
     *
     * @param  string  $actorId  Actor ID (e.g. "apify/web-scraper").
     * @return array The actor resource.
     */
    public function getActor(string $actorId): array
    {
        return $this->request('GET', '/acts/' . urlencode($actorId));
    }

    /**
     * List datasets accessible to the authenticated user.
     *
     * @param  int  $offset  Number of datasets to skip.
     * @param  int  $limit  Maximum number of datasets to return.
     * @return array List of dataset resources.
     */
    public function listDatasets(int $offset = 0, int $limit = 20): array
    {
        return $this->request('GET', '/datasets', [], [
            'offset' => $offset,
            'limit' => $limit,
        ]);
    }

    /**
     * Get details of a specific dataset.
     *
     * @param  string  $datasetId  The dataset ID.
     * @return array The dataset resource.
     */
    public function getDataset(string $datasetId): array
    {
        return $this->request('GET', '/datasets/' . urlencode($datasetId));
    }

    /**
     * Get items from a dataset.
     *
     * @param  string  $datasetId  The dataset ID.
     * @param  string  $format  Response format: "json", "csv", "xml", "html", "xlsx", "rss" or "jsonl".
     * @param  int  $limit  Maximum number of items to return.
     * @param  int  $offset  Number of items to skip.
     * @return array|string The dataset items.
     */
    public function getDatasetItems(string $datasetId, string $format = 'json', int $limit = 100, int $offset = 0): array|string
    {
        $response = $this->rawRequest('GET', '/datasets/' . urlencode($datasetId) . '/items', [], [
            'format' => $format,
            'limit' => $limit,
            'offset' => $offset,
        ]);

        if ($format === 'json' || $format === 'jsonl') {
            return $response->json() ?? [];
        }

        return $response->body();
    }

    /**
     * List key-value stores accessible to the authenticated user.
     *
     * @param  int  $offset  Number of stores to skip.
     * @param  int  $limit  Maximum number of stores to return.
     * @return array List of key-value store resources.
     */
    public function listKeyValueStores(int $offset = 0, int $limit = 20): array
    {
        return $this->request('GET', '/key-value-stores', [], [
            'offset' => $offset,
            'limit' => $limit,
        ]);
    }

    /**
     * Get a record from a key-value store.
     *
     * @param  string  $storeId  The key-value store ID.
     * @param  string  $key  The record key.
     * @return array|string The record value.
     */
    public function getRecord(string $storeId, string $key): array|string
    {
        $response = $this->rawRequest('GET', '/key-value-stores/' . urlencode($storeId) . '/records/' . urlencode($key));

        $contentType = $response->header('Content-Type') ?? '';
        if (str_contains($contentType, 'application/json')) {
            return $response->json() ?? [];
        }

        return $response->body();
    }

    /**
     * Get the currently authenticated user profile.
     *
     * @return array The user resource.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON data.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g. "/acts").
     * @param  array  $body  Request body (for POST/PUT).
     * @param  array  $queryParams  Query string parameters.
     * @return array Parsed JSON response data.
     */
    private function request(string $method, string $path, array $body = [], array $queryParams = []): array
    {
        $response = $this->rawRequest($method, $path, $body, $queryParams);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Apify API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array  $body  Request body.
     * @param  array  $queryParams  Query string parameters.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API token is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $body = [], array $queryParams = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiToken) {
            throw new \RuntimeException('Apify API token is not configured.');
        }

        $url = $this->baseUrl . $path;

        if (!empty($queryParams)) {
            $url .= '?' . http_build_query($queryParams);
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(60);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $body),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'DELETE' => $http->delete($url, $body),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();
                Log::error("Apify API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Apify API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Apify API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Apify API: {$e->getMessage()}");
        }
    }
}
