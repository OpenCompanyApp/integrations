<?php

namespace OpenCompany\Integrations\Grist;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Grist REST API.
 *
 * Wraps HTTP calls to Grist's API endpoints for workspaces, documents,
 * tables, columns, and records. Supports both hosted (docs.getgrist.com)
 * and self-hosted Grist instances.
 */
class GristService
{
    /**
     * @param  string  $apiKey   Grist API key
     * @param  string  $baseUrl  Base URL for the Grist API (default: https://docs.getgrist.com/api)
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://docs.getgrist.com/api',
    ) {}

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    // ── Connection Test ─────────────────────────────────────

    /**
     * Test the connection by listing accessible organizations.
     *
     * @return array<string, mixed>
     */
    public function testConnection(): array
    {
        return $this->request('GET', '/orgs');
    }

    // ── Workspaces ──────────────────────────────────────────

    /**
     * List all workspaces in an organization.
     *
     * @param  int  $orgId  Grist organization ID
     * @return array<string, mixed>
     */
    public function listWorkspaces(int $orgId): array
    {
        return $this->request('GET', "/orgs/{$orgId}/workspaces");
    }

    /**
     * Get a single workspace by ID.
     *
     * @param  int  $workspaceId  Grist workspace ID
     * @return array<string, mixed>
     */
    public function getWorkspace(int $workspaceId): array
    {
        return $this->request('GET', "/workspaces/{$workspaceId}");
    }

    // ── Documents ───────────────────────────────────────────

    /**
     * List all documents in an organization.
     *
     * @param  int  $orgId  Grist organization ID
     * @return array<string, mixed>
     */
    public function listDocs(int $orgId): array
    {
        return $this->request('GET', "/orgs/{$orgId}/docs");
    }

    /**
     * Get a single document by ID.
     *
     * @param  string  $docId  Grist document ID
     * @return array<string, mixed>
     */
    public function getDoc(string $docId): array
    {
        return $this->request('GET', "/docs/{$docId}");
    }

    // ── Tables ──────────────────────────────────────────────

    /**
     * List all tables in a document.
     *
     * @param  string  $docId  Grist document ID
     * @return array<string, mixed>
     */
    public function listTables(string $docId): array
    {
        return $this->request('GET', "/docs/{$docId}/tables");
    }

    /**
     * Get a single table from a document.
     *
     * @param  string  $docId    Grist document ID
     * @param  string  $tableId  Grist table ID
     * @return array<string, mixed>
     */
    public function getTable(string $docId, string $tableId): array
    {
        return $this->request('GET', "/docs/{$docId}/tables/{$tableId}");
    }

    // ── Records ─────────────────────────────────────────────

    /**
     * List records from a table with optional filtering, sorting, and limiting.
     *
     * @param  string       $docId    Grist document ID
     * @param  string       $tableId  Grist table ID
     * @param  int|null     $limit    Maximum number of records to return
     * @param  string|null  $sort     Sort expression (e.g., "-Col1" for descending, "Col2" for ascending)
     * @param  array<string, mixed>|null  $filter  Column-based filter, e.g., ["Col1" => ["val1"]]
     * @return array<string, mixed>
     */
    public function listRecords(string $docId, string $tableId, ?int $limit = null, ?string $sort = null, ?array $filter = null): array
    {
        $path = "/docs/{$docId}/tables/{$tableId}/records";
        $params = [];

        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($sort !== null) {
            $params['sort'] = $sort;
        }
        if ($filter !== null) {
            $params['filter'] = urlencode(json_encode($filter));
        }

        return $this->request('GET', $path, $params);
    }

    /**
     * Get full column data for a table (raw cell values per column).
     *
     * @param  string  $docId    Grist document ID
     * @param  string  $tableId  Grist table ID
     * @return array<string, mixed>
     */
    public function getTableData(string $docId, string $tableId): array
    {
        return $this->request('GET', "/docs/{$docId}/tables/{$tableId}/data");
    }

    /**
     * Create records in a table.
     *
     * @param  string  $docId    Grist document ID
     * @param  string  $tableId  Grist table ID
     * @param  array<int, array<string, mixed>>  $records  Array of field objects, e.g., [{"fields": {"Col1": "val"}}]
     * @return array<string, mixed>
     */
    public function createRecords(string $docId, string $tableId, array $records): array
    {
        return $this->request('POST', "/docs/{$docId}/tables/{$tableId}/records", [
            'records' => $records,
        ]);
    }

    /**
     * Update existing records in a table.
     *
     * @param  string  $docId    Grist document ID
     * @param  string  $tableId  Grist table ID
     * @param  array<int, array<string, mixed>>  $records  Array of record updates, e.g., [{"id": 1, "fields": {"Col1": "new"}}]
     * @return array<string, mixed>
     */
    public function updateRecords(string $docId, string $tableId, array $records): array
    {
        return $this->request('PATCH', "/docs/{$docId}/tables/{$tableId}/records", [
            'records' => $records,
        ]);
    }

    /**
     * Delete records from a table by row IDs.
     *
     * @param  string  $docId      Grist document ID
     * @param  string  $tableId    Grist table ID
     * @param  array<int>  $recordIds  Array of row IDs to delete
     * @return array<string, mixed>
     */
    public function deleteRecords(string $docId, string $tableId, array $recordIds): array
    {
        return $this->request('DELETE', "/docs/{$docId}/tables/{$tableId}/data/delete", $recordIds);
    }

    // ── Columns ─────────────────────────────────────────────

    /**
     * Create a new column in a table.
     *
     * @param  string  $docId     Grist document ID
     * @param  string  $tableId   Grist table ID
     * @param  string  $colId     Column identifier (used as the field key)
     * @param  string  $label     Human-readable column label
     * @param  string  $type      Grist column type (e.g., "Text", "Int", "Numeric", "Bool", "Date", "Choice", "Ref")
     * @param  string  $formula   Optional formula for a formula column
     * @return array<string, mixed>
     */
    public function createColumn(string $docId, string $tableId, string $colId, string $label, string $type, string $formula = ''): array
    {
        $col = [
            'id' => $colId,
            'fields' => [
                'label' => $label,
                'type' => $type,
            ],
        ];

        if ($formula !== '') {
            $col['fields']['formula'] = $formula;
        }

        return $this->request('POST', "/docs/{$docId}/tables/{$tableId}/columns", [
            'columns' => [$col],
        ]);
    }

    /**
     * List all columns in a table.
     *
     * @param  string  $docId    Grist document ID
     * @param  string  $tableId  Grist table ID
     * @return array<string, mixed>
     */
    public function listColumns(string $docId, string $tableId): array
    {
        return $this->request('GET', "/docs/{$docId}/tables/{$tableId}/columns");
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to Grist.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, DELETE)
     * @param  string  $path    API path (e.g., "/orgs", "/docs/{docId}/tables")
     * @param  array<string, mixed>  $data  Query params for GET, body payload for POST/PATCH/DELETE
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('Grist API key is not configured.');
        }

        $url = rtrim($this->baseUrl, '/') . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PATCH'  => $http->patch($url, $data),
                'DELETE' => $http->withBody(json_encode($data), 'application/json')->delete($url),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            $body = $response->json() ?? [];

            if ($response->failed()) {
                $error = $body['error'] ?? $response->body();

                Log::error("Grist API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Grist API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $body;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Grist API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Grist API: {$e->getMessage()}");
        }
    }
}
