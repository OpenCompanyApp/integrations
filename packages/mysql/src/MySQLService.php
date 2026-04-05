<?php

namespace OpenCompany\Integrations\MySQL;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MySQLService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key and base URL.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->baseUrl);
    }

    /**
     * Execute a raw SQL query.
     *
     * @param  string  $sql  The SQL query to execute.
     * @return array<string, mixed> The query result.
     */
    public function query(string $sql): array
    {
        return $this->request('POST', '/query', ['sql' => $sql]);
    }

    /**
     * List all accessible databases.
     *
     * @return array<string, mixed>
     */
    public function listDatabases(): array
    {
        return $this->request('GET', '/databases');
    }

    /**
     * List all tables in a database.
     *
     * @param  string  $database  The database name.
     * @return array<string, mixed>
     */
    public function listTables(string $database): array
    {
        return $this->request('GET', '/databases/' . urlencode($database) . '/tables');
    }

    /**
     * Describe the structure of a table.
     *
     * @param  string  $database  The database name.
     * @param  string  $table  The table name.
     * @return array<string, mixed>
     */
    public function describeTable(string $database, string $table): array
    {
        return $this->request('GET', '/databases/' . urlencode($database) . '/tables/' . urlencode($table));
    }

    /**
     * Insert a row into a table.
     *
     * @param  string  $database  The database name.
     * @param  string  $table  The table name.
     * @param  array<string, mixed>  $data  Column-value pairs to insert.
     * @return array<string, mixed>
     */
    public function insert(string $database, string $table, array $data): array
    {
        return $this->request('POST', '/databases/' . urlencode($database) . '/tables/' . urlencode($table), $data);
    }

    /**
     * Update rows in a table matching a filter.
     *
     * @param  string  $database  The database name.
     * @param  string  $table  The table name.
     * @param  array<string, mixed>  $filter  Column-value pairs to match rows.
     * @param  array<string, mixed>  $data  Column-value pairs to update.
     * @return array<string, mixed>
     */
    public function update(string $database, string $table, array $filter, array $data): array
    {
        return $this->request('PUT', '/databases/' . urlencode($database) . '/tables/' . urlencode($table), [
            'filter' => $filter,
            'data' => $data,
        ]);
    }

    /**
     * Delete rows from a table matching a filter.
     *
     * @param  string  $database  The database name.
     * @param  string  $table  The table name.
     * @param  array<string, mixed>  $filter  Column-value pairs to match rows.
     * @return array<string, mixed>
     */
    public function delete(string $database, string $table, array $filter): array
    {
        return $this->request('DELETE', '/databases/' . urlencode($database) . '/tables/' . urlencode($table), [
            'filter' => $filter,
        ]);
    }

    /**
     * Get the current authenticated user via the ping endpoint.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/ping');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., /query).
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the MySQL REST bridge API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request payload.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('MySQL API key is not configured.');
        }

        if (!$this->baseUrl) {
            throw new \RuntimeException('MySQL host URL is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
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
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("MySQL API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("MySQL API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("MySQL API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("MySQL API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("MySQL API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to MySQL API: {$e->getMessage()}");
        }
    }
}
