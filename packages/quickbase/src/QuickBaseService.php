<?php

namespace OpenCompany\Integrations\QuickBase;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class QuickBaseService
{
    public function __construct(
        private string $accessToken = '',
        private string $realmHostname = '',
        private string $baseUrl = 'https://api.quickbase.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->realmHostname);
    }

    /**
     * Get the configured realm hostname.
     */
    public function getRealmHostname(): string
    {
        return $this->realmHostname;
    }

    /**
     * List all tables in an application.
     *
     * @param  string  $appId  The application ID (dbid).
     * @return array<string, mixed>
     */
    public function listTables(string $appId): array
    {
        return $this->request('GET', '/tables', [
            'appId' => $appId,
        ]);
    }

    /**
     * Get details for a specific table.
     *
     * @param  string  $tableId  The table ID (dbid).
     * @return array<string, mixed>
     */
    public function getTable(string $tableId): array
    {
        return $this->request('GET', '/tables/' . urlencode($tableId));
    }

    /**
     * Query records from a table.
     *
     * @param  string  $tableId  The table ID (dbid).
     * @param  array<string, mixed>  $options  Query options (where, select, sortBy, groupBy, options).
     * @return array<string, mixed>
     */
    public function queryRecords(string $tableId, array $options = []): array
    {
        $body = [];

        if (!empty($options['where'])) {
            $body['where'] = $options['where'];
        }

        if (!empty($options['select'])) {
            $body['select'] = $options['select'];
        }

        if (!empty($options['sortBy'])) {
            $body['sortBy'] = $options['sortBy'];
        }

        if (!empty($options['groupBy'])) {
            $body['groupBy'] = $options['groupBy'];
        }

        if (isset($options['options'])) {
            $body['options'] = $options['options'];
        }

        return $this->request('POST', '/records/query', $body, [
            'tableId' => $tableId,
        ]);
    }

    /**
     * Get a single record by ID.
     *
     * @param  string  $tableId  The table ID (dbid).
     * @param  int  $recordId  The record ID.
     * @return array<string, mixed>
     */
    public function getRecord(string $tableId, int $recordId): array
    {
        return $this->request('GET', '/records/' . $recordId, [], [
            'tableId' => $tableId,
        ]);
    }

    /**
     * Create a new record in a table.
     *
     * @param  string  $tableId  The table ID (dbid).
     * @param  array<int, array<string, mixed>>  $fields  Array of field data: [{fieldId: int, value: mixed}, ...].
     * @return array<string, mixed>
     */
    public function createRecord(string $tableId, array $fields): array
    {
        $body = [
            'to' => $tableId,
            'data' => [
                $fields,
            ],
        ];

        return $this->request('POST', '/records', $body);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE, PATCH).
     * @param  string  $path  API path (relative to base URL).
     * @param  array<string, mixed>  $body  Request body (for POST/PUT/PATCH).
     * @param  array<string, mixed>  $query  Query parameters (for GET).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $body = [], array $query = []): array
    {
        $response = $this->rawRequest($method, $path, $body, $query);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the QuickBase API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE, PATCH).
     * @param  string  $path  API path (relative to base URL).
     * @param  array<string, mixed>  $body  Request body (for POST/PUT/PATCH).
     * @param  array<string, mixed>  $query  Query parameters (for GET).
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the request fails.
     */
    private function rawRequest(string $method, string $path, array $body = [], array $query = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('QuickBase access token is not configured.');
        }

        if (!$this->realmHostname) {
            throw new \RuntimeException('QuickBase realm hostname is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'QB-Realm-Hostname' => $this->realmHostname,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, array_merge($query, $body)),
                'POST' => $http->withQueryParameters($query)->post($url, $body),
                'PUT' => $http->withQueryParameters($query)->put($url, $body),
                'DELETE' => $http->withQueryParameters($query)->delete($url, $body),
                'PATCH' => $http->withQueryParameters($query)->patch($url, $body),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->body();

                Log::error("QuickBase API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("QuickBase API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("QuickBase API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to QuickBase API: {$e->getMessage()}");
        }
    }
}
