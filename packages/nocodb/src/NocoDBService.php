<?php

namespace OpenCompany\Integrations\NocoDB;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the NocoDB REST API (v2).
 *
 * Wraps HTTP calls to NocoDB's API for records, tables, bases,
 * views, and bulk operations on self-hosted instances.
 */
class NocoDBService
{
    private const PATH_PREFIX = '/api/v2';

    /**
     * @param  string  $apiToken  NocoDB API token (xc-token)
     * @param  string  $baseUrl   Base URL of the NocoDB instance (e.g., "https://my-nocodb.example.com")
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->apiToken) && ! empty($this->baseUrl);
    }

    // ── Connection Test ─────────────────────────────────────

    /**
     * Test the connection by listing accessible bases.
     *
     * @return array<string, mixed>
     */
    public function testConnection(): array
    {
        return $this->request('GET', '/meta/bases');
    }

    // ── Records ─────────────────────────────────────────────

    /**
     * List records from a table with optional filtering, sorting, and pagination.
     *
     * @param  string  $tableId  Table ID
     * @param  array<string, mixed>  $params  Query parameters (viewId, limit, offset, where, sort, fields)
     * @return array<string, mixed>
     */
    public function listRecords(string $tableId, array $params = []): array
    {
        return $this->request('GET', "/tables/{$tableId}/records", $params);
    }

    /**
     * Get a single record by ID.
     *
     * @param  string  $tableId   Table ID
     * @param  string  $recordId  Record ID
     * @param  array<string, mixed>  $params  Query parameters (fields)
     * @return array<string, mixed>
     */
    public function getRecord(string $tableId, string $recordId, array $params = []): array
    {
        return $this->request('GET', "/tables/{$tableId}/records/{$recordId}", $params);
    }

    /**
     * Create a new record in a table.
     *
     * @param  string  $tableId  Table ID
     * @param  array<string, mixed>  $data  Field name → value pairs
     * @return array<string, mixed>
     */
    public function createRecord(string $tableId, array $data): array
    {
        return $this->request('POST', "/tables/{$tableId}/records", $data);
    }

    /**
     * Update an existing record (partial update).
     *
     * @param  string  $tableId   Table ID
     * @param  string  $recordId  Record ID
     * @param  array<string, mixed>  $data  Field name → value pairs to update
     * @return array<string, mixed>
     */
    public function updateRecord(string $tableId, string $recordId, array $data): array
    {
        return $this->request('PATCH', "/tables/{$tableId}/records/{$recordId}", $data);
    }

    /**
     * Delete a record from a table.
     *
     * @param  string  $tableId   Table ID
     * @param  string  $recordId  Record ID
     * @return array<string, mixed>
     */
    public function deleteRecord(string $tableId, string $recordId): array
    {
        return $this->request('DELETE', "/tables/{$tableId}/records/{$recordId}");
    }

    // ── Batch Operations ────────────────────────────────────

    /**
     * Bulk create records in a table.
     *
     * @param  string  $tableId  Table ID
     * @param  array<int, array<string, mixed>>  $records  Array of record data objects
     * @return array<string, mixed>
     */
    public function batchCreate(string $tableId, array $records): array
    {
        return $this->request('POST', "/tables/{$tableId}/records/bulk", $records);
    }

    /**
     * Bulk update records in a table.
     *
     * @param  string  $tableId  Table ID
     * @param  array<int, array<string, mixed>>  $records  Array of record data objects, each with an "Id" key
     * @return array<string, mixed>
     */
    public function batchUpdate(string $tableId, array $records): array
    {
        return $this->request('PATCH', "/tables/{$tableId}/records/bulk", $records);
    }

    /**
     * Bulk delete records from a table.
     *
     * @param  string  $tableId     Table ID
     * @param  array<int|string>  $recordIds  Array of record IDs to delete
     * @return array<string, mixed>
     */
    public function batchDelete(string $tableId, array $recordIds): array
    {
        return $this->request('DELETE', "/tables/{$tableId}/records/bulk", $recordIds);
    }

    // ── Meta: Bases ─────────────────────────────────────────

    /**
     * List all bases the token has access to.
     *
     * @return array<string, mixed>
     */
    public function listBases(): array
    {
        return $this->request('GET', '/meta/bases');
    }

    /**
     * Get a single base by ID.
     *
     * @param  string  $baseId  Base ID
     * @return array<string, mixed>
     */
    public function getBase(string $baseId): array
    {
        return $this->request('GET', "/meta/bases/{$baseId}");
    }

    // ── Meta: Tables ────────────────────────────────────────

    /**
     * List all tables in a base.
     *
     * @param  string  $baseId  Base ID
     * @return array<string, mixed>
     */
    public function listTables(string $baseId): array
    {
        return $this->request('GET', "/meta/bases/{$baseId}/tables");
    }

    /**
     * Get a single table by ID.
     *
     * @param  string  $tableId  Table ID
     * @return array<string, mixed>
     */
    public function getTable(string $tableId): array
    {
        return $this->request('GET', "/tables/{$tableId}");
    }

    /**
     * Create a new table in a base.
     *
     * @param  string  $baseId   Base ID
     * @param  string  $tableName  Name for the new table
     * @param  array<int, array<string, mixed>>  $columns  Column definitions
     * @return array<string, mixed>
     */
    public function createTable(string $baseId, string $tableName, array $columns): array
    {
        return $this->request('POST', "/meta/bases/{$baseId}/tables", [
            'table_name' => $tableName,
            'columns' => $columns,
        ]);
    }

    // ── Meta: Views ─────────────────────────────────────────

    /**
     * List views for a table.
     *
     * @param  string  $tableId  Table ID
     * @return array<string, mixed>
     */
    public function listViews(string $tableId): array
    {
        return $this->request('GET', "/tables/{$tableId}/views");
    }

    // ── Records: Count ──────────────────────────────────────

    /**
     * Count records in a table with optional filtering.
     *
     * @param  string  $tableId  Table ID
     * @param  array<string, mixed>  $params  Query parameters (where)
     * @return array<string, mixed>
     */
    public function countRecords(string $tableId, array $params = []): array
    {
        return $this->request('GET', "/tables/{$tableId}/records/count", $params);
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to NocoDB.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, DELETE)
     * @param  string  $path    API path relative to the base URL + path prefix
     * @param  array<string, mixed>  $data  Query parameters (GET/DELETE) or body payload (POST/PATCH)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->apiToken) {
            throw new \RuntimeException('NocoDB API token is not configured.');
        }
        if (! $this->baseUrl) {
            throw new \RuntimeException('NocoDB base URL is not configured.');
        }

        $url = rtrim($this->baseUrl, '/') . self::PATH_PREFIX . $path;

        try {
            $http = Http::withHeaders([
                'xc-token' => $this->apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PATCH'  => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            $body = $response->json() ?? [];

            if ($response->failed()) {
                $error = $body['msg'] ?? $body['error'] ?? $response->body();

                Log::error("NocoDB API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("NocoDB API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $body;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("NocoDB API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to NocoDB API: {$e->getMessage()}");
        }
    }
}
