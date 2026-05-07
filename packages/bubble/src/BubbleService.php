<?php

namespace OpenCompany\Integrations\Bubble;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for Bubble's built-in Data API and Workflow API.
 *
 * Handles bearer-token authentication, the documented /api/1.1 API root, Data API
 * record operations, exposed backend workflow calls, initialization calls, and Swagger discovery.
 */
class BubbleService
{
    /**
     * @param  string  $apiKey  Bubble API token
     * @param  string  $baseUrl  Bubble app URL, without /api/1.1
     * @param  string  $apiPath  Bubble API path, usually /api/1.1 or /version-test/api/1.1
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = '',
        private string $apiPath = '/api/1.1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->apiPath = '/' . trim($this->apiPath ?: '/api/1.1', '/');

        if (str_ends_with($this->baseUrl, '/api/1.1')) {
            $this->baseUrl = substr($this->baseUrl, 0, -8);
        }
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '' && $this->baseUrl !== '';
    }

    /**
     * Get the Bubble app Swagger specification.
     *
     * @return array<string, mixed>
     */
    public function getSwagger(): array
    {
        return $this->request('GET', $this->apiPath . '/meta');
    }

    /**
     * List records of a given Bubble type.
     *
     * @param  string  $type  Bubble data type name
     * @param  array<int, array<string, mixed>>  $constraints  Bubble constraint objects
     * @param  int  $limit  Page size
     * @param  int  $cursor  Cursor/offset
     * @param  string|null  $sortField  Sort field
     * @param  bool|null  $descending  Whether to sort descending
     * @return array<string, mixed>
     */
    public function listRecords(string $type, array $constraints = [], int $limit = 100, int $cursor = 0, ?string $sortField = null, ?bool $descending = null): array
    {
        return $this->request('GET', $this->dataPath($type), array_filter([
            'constraints' => $constraints === [] ? null : json_encode($constraints),
            'limit' => $limit,
            'cursor' => $cursor,
            'sort_field' => $sortField,
            'descending' => $descending,
        ], static fn (mixed $value): bool => $value !== null));
    }

    /**
     * Get one Bubble record.
     *
     * @param  string  $type  Bubble data type name
     * @param  string  $id  Bubble unique ID
     * @return array<string, mixed>
     */
    public function getRecord(string $type, string $id): array
    {
        return $this->request('GET', $this->dataPath($type, $id));
    }

    /**
     * Create a Bubble record.
     *
     * @param  string  $type  Bubble data type name
     * @param  array<string, mixed>  $fields  Field values
     * @return array<string, mixed>
     */
    public function createRecord(string $type, array $fields): array
    {
        return $this->request('POST', $this->dataPath($type), $fields);
    }

    /**
     * Update a Bubble record.
     *
     * @param  string  $type  Bubble data type name
     * @param  string  $id  Bubble unique ID
     * @param  array<string, mixed>  $fields  Field values
     * @return array<string, mixed>
     */
    public function updateRecord(string $type, string $id, array $fields): array
    {
        return $this->request('PATCH', $this->dataPath($type, $id), $fields);
    }

    /**
     * Replace a Bubble record.
     *
     * @param  string  $type  Bubble data type name
     * @param  string  $id  Bubble unique ID
     * @param  array<string, mixed>  $fields  Full field payload
     * @return array<string, mixed>
     */
    public function replaceRecord(string $type, string $id, array $fields): array
    {
        return $this->request('PUT', $this->dataPath($type, $id), $fields);
    }

    /**
     * Delete a Bubble record.
     *
     * @param  string  $type  Bubble data type name
     * @param  string  $id  Bubble unique ID
     * @return array<string, mixed>
     */
    public function deleteRecord(string $type, string $id): array
    {
        return $this->request('DELETE', $this->dataPath($type, $id));
    }

    /**
     * Trigger an exposed Bubble API workflow using POST.
     *
     * @param  string  $workflow  API workflow name
     * @param  array<string, mixed>  $payload  JSON body
     * @param  bool  $initialize  Append /initialize for Detect data mode
     * @return array<string, mixed>
     */
    public function triggerWorkflow(string $workflow, array $payload = [], bool $initialize = false): array
    {
        $path = $this->workflowPath($workflow) . ($initialize ? '/initialize' : '');

        return $this->request('POST', $path, $payload);
    }

    /**
     * Trigger an exposed Bubble API workflow using GET query parameters.
     *
     * @param  string  $workflow  API workflow name
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>
     */
    public function triggerWorkflowGet(string $workflow, array $params = []): array
    {
        return $this->request('GET', $this->workflowPath($workflow), $params);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API path
     * @param  array<string, mixed>  $data  Query parameters or JSON body
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }

        return ['message' => trim($response->body())];
    }

    /**
     * Dispatch a raw HTTP request to Bubble.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API path
     * @param  array<string, mixed>  $data  Query parameters or JSON body
     * @return Response
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (! $this->isConfigured()) {
            throw new RuntimeException('Bubble API key and app URL are required.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Bubble API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Bubble API: {$e->getMessage()}");
        }
    }

    /**
     * Build a Data API path.
     */
    private function dataPath(string $type, ?string $id = null): string
    {
        $path = $this->apiPath . '/obj/' . rawurlencode($type);

        return $id === null ? $path : $path . '/' . rawurlencode($id);
    }

    /**
     * Build a Workflow API path.
     */
    private function workflowPath(string $workflow): string
    {
        return $this->apiPath . '/wf/' . rawurlencode($workflow);
    }

    /**
     * Log and throw a normalized Bubble API error.
     *
     * @throws RuntimeException
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $contentType = $response->header('Content-Type');
        $body = $response->body();

        if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
            Log::warning("Bubble API returned HTML for {$method} {$path}", [
                'status' => $response->status(),
            ]);

            throw new RuntimeException("Bubble API endpoint not available (HTTP {$response->status()}). Check the app URL, version path, API settings, and data type or workflow name.");
        }

        $error = $response->json('message') ?? $response->json('error') ?? $body;

        Log::error("Bubble API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new RuntimeException("Bubble API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }
}
