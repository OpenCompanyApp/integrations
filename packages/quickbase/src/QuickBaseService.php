<?php

namespace OpenCompany\Integrations\QuickBase;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Quickbase REST API.
 *
 * Handles user-token authentication, realm headers, request dispatch, and error
 * handling for apps, tables, fields, records, reports, and relationships.
 */
class QuickBaseService
{
    /**
     * @param  string  $accessToken  Quickbase user token.
     * @param  string  $realmHostname  Quickbase realm hostname.
     * @param  string  $baseUrl  Base URL for the Quickbase REST API.
     */
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

    // ── Apps ───────────────────────────────────────────────

    /**
     * List apps available to the authenticated user.
     *
     * @param  array<string, mixed>  $params  Query parameters such as name, limit, or offset.
     * @return array<string, mixed>
     */
    public function listApps(array $params = []): array
    {
        return $this->request('GET', '/apps', $params);
    }

    /**
     * Get details for a specific app.
     *
     * @param  string  $appId  The application ID.
     * @return array<string, mixed>
     */
    public function getApp(string $appId): array
    {
        return $this->request('GET', '/apps/' . urlencode($appId));
    }

    /**
     * Create a new Quickbase app.
     *
     * @param  array<string, mixed>  $body  App creation payload.
     * @return array<string, mixed>
     */
    public function createApp(array $body): array
    {
        return $this->request('POST', '/apps', $body);
    }

    /**
     * Copy an existing Quickbase app.
     *
     * @param  string  $appId  The source app ID.
     * @param  array<string, mixed>  $body  Copy options.
     * @return array<string, mixed>
     */
    public function copyApp(string $appId, array $body = []): array
    {
        return $this->request('POST', '/apps/' . urlencode($appId) . '/copy', $body);
    }

    /**
     * Delete an app.
     *
     * @param  string  $appId  The application ID.
     * @param  string|null  $name  Optional app name confirmation required by some realms.
     * @return array<string, mixed>
     */
    public function deleteApp(string $appId, ?string $name = null): array
    {
        $body = $name !== null && $name !== '' ? ['name' => $name] : [];

        return $this->request('DELETE', '/apps/' . urlencode($appId), $body);
    }

    // ── Tables ─────────────────────────────────────────────

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
     * Create a table in an app.
     *
     * @param  string  $appId  The application ID.
     * @param  array<string, mixed>  $body  Table creation payload.
     * @return array<string, mixed>
     */
    public function createTable(string $appId, array $body): array
    {
        return $this->request('POST', '/tables', $body, ['appId' => $appId]);
    }

    /**
     * Update table metadata.
     *
     * @param  string  $tableId  The table ID.
     * @param  array<string, mixed>  $body  Table attributes to update.
     * @return array<string, mixed>
     */
    public function updateTable(string $tableId, array $body): array
    {
        return $this->request('POST', '/tables/' . urlencode($tableId), $body);
    }

    /**
     * Delete a table.
     *
     * @param  string  $tableId  The table ID.
     * @return array<string, mixed>
     */
    public function deleteTable(string $tableId): array
    {
        return $this->request('DELETE', '/tables/' . urlencode($tableId));
    }

    // ── Fields ─────────────────────────────────────────────

    /**
     * List fields in a table.
     *
     * @param  string  $tableId  The table ID.
     * @param  array<string, mixed>  $params  Query parameters such as includeFieldPerms.
     * @return array<string, mixed>
     */
    public function listFields(string $tableId, array $params = []): array
    {
        return $this->request('GET', '/fields', $params, ['tableId' => $tableId]);
    }

    /**
     * Get field details.
     *
     * @param  string  $tableId  The table ID.
     * @param  int  $fieldId  The field ID.
     * @return array<string, mixed>
     */
    public function getField(string $tableId, int $fieldId): array
    {
        return $this->request('GET', '/fields/' . $fieldId, [], ['tableId' => $tableId]);
    }

    /**
     * Create a field in a table.
     *
     * @param  string  $tableId  The table ID.
     * @param  array<string, mixed>  $body  Field creation payload.
     * @return array<string, mixed>
     */
    public function createField(string $tableId, array $body): array
    {
        return $this->request('POST', '/fields', $body, ['tableId' => $tableId]);
    }

    /**
     * Update field properties.
     *
     * @param  string  $tableId  The table ID.
     * @param  int  $fieldId  The field ID.
     * @param  array<string, mixed>  $body  Field properties to update.
     * @return array<string, mixed>
     */
    public function updateField(string $tableId, int $fieldId, array $body): array
    {
        return $this->request('POST', '/fields/' . $fieldId, $body, ['tableId' => $tableId]);
    }

    /**
     * Delete a field.
     *
     * @param  string  $tableId  The table ID.
     * @param  int  $fieldId  The field ID.
     * @return array<string, mixed>
     */
    public function deleteField(string $tableId, int $fieldId): array
    {
        return $this->request('DELETE', '/fields/' . $fieldId, [], ['tableId' => $tableId]);
    }

    // ── Records ────────────────────────────────────────────

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
     * Upsert one or more records.
     *
     * @param  string  $tableId  The table ID.
     * @param  array<int, array<string, mixed>>  $data  Record data array.
     * @param  int|null  $mergeFieldId  Optional merge field ID.
     * @param  array<int, int>  $fieldsToReturn  Optional field IDs to return.
     * @return array<string, mixed>
     */
    public function upsertRecords(string $tableId, array $data, ?int $mergeFieldId = null, array $fieldsToReturn = []): array
    {
        $body = [
            'to' => $tableId,
            'data' => $data,
        ];

        if ($mergeFieldId !== null) {
            $body['mergeFieldId'] = $mergeFieldId;
        }

        if ($fieldsToReturn !== []) {
            $body['fieldsToReturn'] = $fieldsToReturn;
        }

        return $this->request('POST', '/records', $body);
    }

    /**
     * Delete records matching a Quickbase where clause.
     *
     * @param  string  $tableId  The table ID.
     * @param  string  $where  Quickbase query expression.
     * @return array<string, mixed>
     */
    public function deleteRecords(string $tableId, string $where): array
    {
        return $this->request('DELETE', '/records', [
            'from' => $tableId,
            'where' => $where,
        ]);
    }

    // ── Reports and relationships ─────────────────────────

    /**
     * List reports for a table.
     *
     * @param  string  $tableId  The table ID.
     * @return array<string, mixed>
     */
    public function listReports(string $tableId): array
    {
        return $this->request('GET', '/reports', [], ['tableId' => $tableId]);
    }

    /**
     * Get report metadata.
     *
     * @param  string  $tableId  The table ID.
     * @param  string  $reportId  The report ID.
     * @return array<string, mixed>
     */
    public function getReport(string $tableId, string $reportId): array
    {
        return $this->request('GET', '/reports/' . urlencode($reportId), [], ['tableId' => $tableId]);
    }

    /**
     * Run a report.
     *
     * @param  string  $tableId  The table ID.
     * @param  string  $reportId  The report ID.
     * @param  array<string, mixed>  $body  Report run options.
     * @return array<string, mixed>
     */
    public function runReport(string $tableId, string $reportId, array $body = []): array
    {
        return $this->request('POST', '/reports/' . urlencode($reportId) . '/run', $body, ['tableId' => $tableId]);
    }

    /**
     * List relationships for a table.
     *
     * @param  string  $tableId  The table ID.
     * @return array<string, mixed>
     */
    public function listRelationships(string $tableId): array
    {
        return $this->request('GET', '/tables/' . urlencode($tableId) . '/relationships');
    }

    /**
     * Create a table relationship.
     *
     * @param  string  $tableId  The parent table ID.
     * @param  array<string, mixed>  $body  Relationship creation payload.
     * @return array<string, mixed>
     */
    public function createRelationship(string $tableId, array $body): array
    {
        return $this->request('POST', '/tables/' . urlencode($tableId) . '/relationships', $body);
    }

    /**
     * Delete a table relationship.
     *
     * @param  string  $tableId  The table ID.
     * @param  int  $relationshipId  The relationship ID.
     * @return array<string, mixed>
     */
    public function deleteRelationship(string $tableId, int $relationshipId): array
    {
        return $this->request('DELETE', '/tables/' . urlencode($tableId) . '/relationships/' . $relationshipId);
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

    // ── Generic API ────────────────────────────────────────

    /**
     * Call a documented Quickbase REST API GET endpoint.
     *
     * @param  string  $path  Endpoint path relative to /v1.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $params);
    }

    /**
     * Call a documented Quickbase REST API POST endpoint.
     *
     * @param  string  $path  Endpoint path relative to /v1.
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = [], array $query = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $body, $query);
    }

    /**
     * Call a documented Quickbase REST API DELETE endpoint.
     *
     * @param  string  $path  Endpoint path relative to /v1.
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $body = [], array $query = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $body, $query);
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

    /**
     * Normalize a user-supplied path for generic REST helpers.
     */
    private function normalizePath(string $path): string
    {
        $path = trim($path);
        $path = preg_replace('#^https?://[^/]+/v1#', '', $path) ?? $path;
        $path = preg_replace('#^/v1#', '', $path) ?? $path;
        $path = '/' . ltrim($path, '/');

        if ($path === '/') {
            throw new \InvalidArgumentException('A Quickbase API path is required.');
        }

        return $path;
    }
}
