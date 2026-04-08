<?php

namespace OpenCompany\Integrations\Coda;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service class for interacting with the Coda API.
 *
 * Handles authentication, HTTP requests, and response parsing for all Coda
 * API endpoints including docs, tables, rows, columns, and pages.
 */
class CodaService
{
    /**
     * Create a new CodaService instance.
     *
     * @param  string  $apiKey  The Coda API token for authentication.
     * @param  string  $baseUrl  The base URL for the Coda API.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://coda.io/apis/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    /**
     * Test the connection by fetching the current user.
     *
     * @return array{name: string, loginId: string, ...} The user profile from Coda.
     *
     * @throws \RuntimeException If the request fails.
     */
    public function whoami(): array
    {
        return $this->request('GET', '/whoami');
    }

    /**
     * List docs accessible to the authenticated user.
     *
     * @param  array<string, mixed>  $params  Query parameters (query, isOwner, limit, pageToken).
     * @return array<string, mixed> The paginated list of docs.
     */
    public function listDocs(array $params = []): array
    {
        return $this->request('GET', '/docs', $params);
    }

    /**
     * Get a single doc by ID.
     *
     * @param  string  $docId  The doc ID.
     * @return array<string, mixed> The doc resource.
     */
    public function getDoc(string $docId): array
    {
        return $this->request('GET', '/docs/' . urlencode($docId));
    }

    /**
     * List tables in a doc.
     *
     * @param  string  $docId  The doc ID.
     * @param  array<string, mixed>  $params  Query parameters (limit, pageToken).
     * @return array<string, mixed> The paginated list of tables.
     */
    public function listTables(string $docId, array $params = []): array
    {
        return $this->request('GET', '/docs/' . urlencode($docId) . '/tables', $params);
    }

    /**
     * Get a single table by ID.
     *
     * @param  string  $docId  The doc ID.
     * @param  string  $tableId  The table ID or name.
     * @return array<string, mixed> The table resource.
     */
    public function getTable(string $docId, string $tableId): array
    {
        return $this->request('GET', '/docs/' . urlencode($docId) . '/tables/' . urlencode($tableId));
    }

    /**
     * List columns in a table.
     *
     * @param  string  $docId  The doc ID.
     * @param  string  $tableId  The table ID or name.
     * @param  array<string, mixed>  $params  Query parameters (limit, pageToken).
     * @return array<string, mixed> The paginated list of columns.
     */
    public function listColumns(string $docId, string $tableId, array $params = []): array
    {
        return $this->request('GET', '/docs/' . urlencode($docId) . '/tables/' . urlencode($tableId) . '/columns', $params);
    }

    /**
     * List rows in a table.
     *
     * @param  string  $docId  The doc ID.
     * @param  string  $tableId  The table ID or name.
     * @param  array<string, mixed>  $params  Query parameters (limit, useColumnNames, pageToken, sortBy, visibleSortOrder).
     * @return array<string, mixed> The paginated list of rows.
     */
    public function listRows(string $docId, string $tableId, array $params = []): array
    {
        return $this->request('GET', '/docs/' . urlencode($docId) . '/tables/' . urlencode($tableId) . '/rows', $params);
    }

    /**
     * Get a single row by ID.
     *
     * @param  string  $docId  The doc ID.
     * @param  string  $tableId  The table ID or name.
     * @param  string  $rowId  The row ID.
     * @param  array<string, mixed>  $params  Query parameters (useColumnNames).
     * @return array<string, mixed> The row resource.
     */
    public function getRow(string $docId, string $tableId, string $rowId, array $params = []): array
    {
        return $this->request('GET', '/docs/' . urlencode($docId) . '/tables/' . urlencode($tableId) . '/rows/' . urlencode($rowId), $params);
    }

    /**
     * Insert rows into a table.
     *
     * @param  string  $docId  The doc ID.
     * @param  string  $tableId  The table ID or name.
     * @param  array<int, array<string, mixed>>  $rows  Array of row objects with cells.
     * @param  array<string, mixed>  $options  Additional options (keyColumns, disableParsing).
     * @return array<string, mixed> The request ID for tracking the async operation.
     */
    public function insertRows(string $docId, string $tableId, array $rows, array $options = []): array
    {
        $body = array_merge(['rows' => $rows], $options);

        return $this->request('POST', '/docs/' . urlencode($docId) . '/tables/' . urlencode($tableId) . '/rows', $body);
    }

    /**
     * Update a single row.
     *
     * @param  string  $docId  The doc ID.
     * @param  string  $tableId  The table ID or name.
     * @param  string  $rowId  The row ID.
     * @param  array<int, array<string, mixed>>  $cells  Array of cell update objects (column, value).
     * @return array<string, mixed> The request ID for tracking the async operation.
     */
    public function updateRow(string $docId, string $tableId, string $rowId, array $cells): array
    {
        $body = ['row' => ['cells' => $cells]];

        return $this->request('PUT', '/docs/' . urlencode($docId) . '/tables/' . urlencode($tableId) . '/rows/' . urlencode($rowId), $body);
    }

    /**
     * Delete a single row.
     *
     * @param  string  $docId  The doc ID.
     * @param  string  $tableId  The table ID or name.
     * @param  string  $rowId  The row ID.
     * @return array<string, mixed> Empty array on success.
     */
    public function deleteRow(string $docId, string $tableId, string $rowId): array
    {
        return $this->request('DELETE', '/docs/' . urlencode($docId) . '/tables/' . urlencode($tableId) . '/rows/' . urlencode($rowId));
    }

    /**
     * List pages in a doc.
     *
     * @param  string  $docId  The doc ID.
     * @param  array<string, mixed>  $params  Query parameters (limit, pageToken, sortBy).
     * @return array<string, mixed> The paginated list of pages.
     */
    public function listPages(string $docId, array $params = []): array
    {
        return $this->request('GET', '/docs/' . urlencode($docId) . '/pages', $params);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path relative to the base URL.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed> The parsed JSON response.
     *
     * @throws \RuntimeException If the request fails or the service is not configured.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 202) {
            return $response->json() ?? [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Coda API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path relative to the base URL.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('Coda API token is not configured.');
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

            if (! $response->successful() && $response->status() !== 202) {
                $error = $response->json('message') ?? $response->body();
                Log::error("Coda API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Coda API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Coda API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Coda API: {$e->getMessage()}");
        }
    }
}
