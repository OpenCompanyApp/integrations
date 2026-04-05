<?php

namespace OpenCompany\Integrations\Baserow;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Baserow API.
 *
 * Wraps all Baserow REST endpoints (rows, tables, fields, databases)
 * with token-based authentication and consistent error handling.
 */
class BaserowService
{
    /**
     * Create a new BaserowService instance.
     *
     * @param string $apiToken Baserow API token (JWT or permanent database token)
     * @param string $baseUrl  Base URL of the Baserow API (default: https://api.baserow.io/api)
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://api.baserow.io/api',
    ) {}

    /**
     * Check whether the service has been configured with an API token.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiToken);
    }

    // ── Rows ──────────────────────────────────────────────────────────────

    /**
     * List rows in a table with optional filtering, searching, and pagination.
     *
     * @param int   $tableId   Baserow table ID
     * @param array $params    Query parameters (limit, offset, search, order_by, filter_type, filters, field_ids)
     * @return array<string, mixed> API response containing 'results' and 'count'
     */
    public function listRows(int $tableId, array $params = []): array
    {
        return $this->request('GET', "/database/rows/table/{$tableId}/", $params);
    }

    /**
     * Get a single row by ID.
     *
     * @param int $tableId Baserow table ID
     * @param int $rowId   Row ID to retrieve
     * @return array<string, mixed> Row data with field values
     */
    public function getRow(int $tableId, int $rowId): array
    {
        return $this->request('GET', "/database/rows/table/{$tableId}/{$rowId}/");
    }

    /**
     * Create a new row in a table.
     *
     * @param int   $tableId Baserow table ID
     * @param array $data    Flat key-value field data, e.g. {"field_1": "value", "field_2": 42}
     * @param int|null $before If provided, position the new row before this row ID
     * @return array<string, mixed> Created row data
     */
    public function createRow(int $tableId, array $data, ?int $before = null): array
    {
        $query = $before !== null ? ['before' => $before] : [];

        return $this->request('POST', "/database/rows/table/{$tableId}/", $data, $query);
    }

    /**
     * Update an existing row.
     *
     * @param int   $tableId Baserow table ID
     * @param int   $rowId   Row ID to update
     * @param array $data    Flat key-value field data to patch
     * @return array<string, mixed> Updated row data
     */
    public function updateRow(int $tableId, int $rowId, array $data): array
    {
        return $this->request('PATCH', "/database/rows/table/{$tableId}/{$rowId}/", $data);
    }

    /**
     * Delete a row by ID.
     *
     * @param int $tableId Baserow table ID
     * @param int $rowId   Row ID to delete
     * @return array<string, mixed> Empty response on success
     */
    public function deleteRow(int $tableId, int $rowId): array
    {
        return $this->request('DELETE', "/database/rows/table/{$tableId}/{$rowId}/");
    }

    /**
     * Batch-create multiple rows in a table.
     *
     * @param int   $tableId Baserow table ID
     * @param array $records Array of row data arrays
     * @return array<string, mixed> Created rows
     */
    public function batchCreate(int $tableId, array $records): array
    {
        return $this->request('POST', "/database/rows/table/{$tableId}/batch/", ['items' => $records]);
    }

    /**
     * Batch-update multiple rows in a table.
     *
     * @param int   $tableId Baserow table ID
     * @param array $records Array of row data arrays (each must include an 'id' key)
     * @return array<string, mixed> Updated rows
     */
    public function batchUpdate(int $tableId, array $records): array
    {
        return $this->request('PATCH', "/database/rows/table/{$tableId}/batch/", ['items' => $records]);
    }

    /**
     * Batch-delete multiple rows by ID.
     *
     * @param int   $tableId Baserow table ID
     * @param array $rowIds  Array of row IDs to delete
     * @return array<string, mixed> Empty response on success
     */
    public function batchDelete(int $tableId, array $rowIds): array
    {
        return $this->request('POST', "/database/rows/table/{$tableId}/batch-delete/", ['items' => $rowIds]);
    }

    // ── Tables & Databases ────────────────────────────────────────────────

    /**
     * List all tables in a Baserow database (application).
     *
     * @param int $databaseId Baserow database/application ID
     * @return array<string, mixed> List of tables
     */
    public function listTables(int $databaseId): array
    {
        return $this->request('GET', "/database/tables/database/{$databaseId}/");
    }

    /**
     * List all databases (applications) accessible to the token.
     *
     * @param string|null $type Optional type filter (e.g. "database")
     * @return array<string, mixed> List of applications
     */
    public function listDatabases(?string $type = null): array
    {
        $params = $type !== null ? ['type' => $type] : [];

        return $this->request('GET', '/applications/', $params);
    }

    /**
     * Get details for a single table.
     *
     * @param int $tableId Baserow table ID
     * @return array<string, mixed> Table metadata
     */
    public function getTable(int $tableId): array
    {
        return $this->request('GET', "/database/tables/{$tableId}/");
    }

    /**
     * List all fields in a table.
     *
     * @param int $tableId Baserow table ID
     * @return array<string, mixed> List of field definitions
     */
    public function listFields(int $tableId): array
    {
        return $this->request('GET', "/database/fields/table/{$tableId}/");
    }

    // ── HTTP ──────────────────────────────────────────────────────────────

    /**
     * Execute an HTTP request against the Baserow API.
     *
     * @param string $method  HTTP method (GET, POST, PATCH, DELETE)
     * @param string $path    API path (e.g. /database/rows/table/1/)
     * @param array  $body    Request body (for POST/PATCH) or query params (for GET)
     * @param array  $query   Additional query parameters appended to URL
     * @return array<string, mixed> Decoded JSON response
     *
     * @throws \RuntimeException On connection failure or API error
     */
    private function request(string $method, string $path, array $body = [], array $query = []): array
    {
        if (! $this->apiToken) {
            throw new \RuntimeException('Baserow API token is not configured.');
        }

        $url = rtrim($this->baseUrl, '/') . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Token ' . $this->apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            // Append extra query parameters to URL
            if (! empty($query)) {
                $url .= (str_contains($url, '?') ? '&' : '?') . http_build_query($query);
            }

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $body),
                'POST'   => $http->post($url, $body),
                'PATCH'  => $http->patch($url, $body),
                'DELETE' => $http->delete($url),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->failed()) {
                $status = $response->status();
                $error  = $response->body();
                Log::error("Baserow API error: {$method} {$path}", ['status' => $status, 'body' => $error]);
                throw new \RuntimeException("Baserow API error ({$status}): {$error}");
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Baserow API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new \RuntimeException("Failed to connect to Baserow API: {$e->getMessage()}");
        }
    }
}
