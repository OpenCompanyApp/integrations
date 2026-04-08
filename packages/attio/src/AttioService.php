<?php

namespace OpenCompany\Integrations\Attio;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AttioService
{
    /**
     * Create a new Attio service instance.
     *
     * @param  string  $accessToken  The Attio API token used for Bearer authentication.
     * @param  string  $baseUrl  The base URL for the Attio API (default: https://api.attio.com).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.attio.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List records for a given object using the query endpoint.
     *
     * Uses POST /v2/objects/{object_id}/records/query to support filtering,
     * sorting, and pagination.
     *
     * @param  string  $objectId  The object slug or ID (e.g. "people", "companies").
     * @param  int  $limit  Maximum number of records to return (default: 20, max: 500).
     * @param  int  $offset  Number of records to skip for pagination.
     * @param  array<int, array<string, mixed>>  $sorts  Sort definitions, e.g. [["attribute" => ["slug" => "name"], "direction" => "asc"]].
     * @param  array<string, mixed>  $filters  Filter definitions following the Attio filter grammar.
     * @return array<string, mixed> The paginated list of records.
     */
    public function listRecords(string $objectId, int $limit = 20, int $offset = 0, array $sorts = [], array $filters = []): array
    {
        $body = [
            'limit' => $limit,
            'offset' => $offset,
        ];

        if (!empty($sorts)) {
            $body['sorts'] = $sorts;
        }

        if (!empty($filters)) {
            $body['filter'] = $filters;
        }

        return $this->request('POST', "/v2/objects/{$objectId}/records/query", $body);
    }

    /**
     * Get a single record by ID.
     *
     * @param  string  $objectId  The object slug or ID (e.g. "people", "companies").
     * @param  string  $recordId  The record UUID.
     * @return array<string, mixed> The record data.
     */
    public function getRecord(string $objectId, string $recordId): array
    {
        return $this->request('GET', "/v2/objects/{$objectId}/records/{$recordId}");
    }

    /**
     * Create a new record for a given object type.
     *
     * @param  string  $objectId  The object slug or ID (e.g. "people", "companies").
     * @param  array<string, mixed>  $data  The record data keyed by attribute slug.
     * @return array<string, mixed> The created record.
     */
    public function createRecord(string $objectId, array $data): array
    {
        return $this->request('POST', "/v2/objects/{$objectId}/records", [
            'data' => $data,
        ]);
    }

    /**
     * List all objects defined in the workspace.
     *
     * @return array<string, mixed> The list of objects.
     */
    public function listObjects(): array
    {
        return $this->request('GET', '/v2/objects');
    }

    /**
     * Get a single object by slug or ID.
     *
     * @param  string  $objectId  The object slug or UUID.
     * @return array<string, mixed> The object definition.
     */
    public function getObject(string $objectId): array
    {
        return $this->request('GET', "/v2/objects/{$objectId}");
    }

    /**
     * List all workspaces accessible to the authenticated user.
     *
     * @return array<string, mixed> The list of workspaces.
     */
    public function listWorkspaces(): array
    {
        return $this->request('GET', '/v2/workspaces');
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed> The current user data.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v2/self');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, DELETE).
     * @param  string  $path  API path relative to the base URL.
     * @param  array<string, mixed>  $data  Query parameters (GET) or JSON body (POST/PATCH/DELETE).
     * @return array<string, mixed> The parsed JSON response body.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Attio API.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, DELETE).
     * @param  string  $path  API path relative to the base URL.
     * @param  array<string, mixed>  $data  Query parameters (GET) or JSON body (POST/PATCH/DELETE).
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the access token is missing, the connection fails, or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Attio access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Attio API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Attio API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Attio API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Attio API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Attio API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Attio API: {$e->getMessage()}");
        }
    }
}
