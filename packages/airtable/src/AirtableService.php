<?php

namespace OpenCompany\Integrations\Airtable;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Airtable REST API.
 *
 * Wraps HTTP calls to Airtable's v0 endpoints for records, bases,
 * schemas, fields, views, and attachments.
 */
class AirtableService
{
    private const BASE_URL = 'https://api.airtable.com/v0';

    /**
     * @param  string  $accessToken  Airtable Personal Access Token or OAuth access token
     */
    public function __construct(
        private string $accessToken = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
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
     * @param  string  $baseId   Airtable base ID (e.g., "appXXXXXXXXXXXX")
     * @param  string  $table    Table ID or name
     * @param  array<string, mixed>  $params  Query parameters (view, filterByFormula, maxRecords, offset, fields[], sort[])
     * @return array<string, mixed>
     */
    public function listRecords(string $baseId, string $table, array $params = []): array
    {
        return $this->request('GET', "/{$baseId}/" . urlencode($table), $params);
    }

    /**
     * Get a single record by ID.
     *
     * @param  string  $baseId    Airtable base ID
     * @param  string  $table     Table ID or name
     * @param  string  $recordId  Record ID (e.g., "recXXXXXXXXXXXX")
     * @return array<string, mixed>
     */
    public function getRecord(string $baseId, string $table, string $recordId): array
    {
        return $this->request('GET', "/{$baseId}/" . urlencode($table) . "/{$recordId}");
    }

    /**
     * Create a new record in a table.
     *
     * @param  string  $baseId  Airtable base ID
     * @param  string  $table   Table ID or name
     * @param  array<string, mixed>  $fields  Field name → value pairs
     * @return array<string, mixed>
     */
    public function createRecord(string $baseId, string $table, array $fields): array
    {
        return $this->request('POST', "/{$baseId}/" . urlencode($table), [
            'fields' => $fields,
        ]);
    }

    /**
     * Update an existing record (partial update).
     *
     * @param  string  $baseId    Airtable base ID
     * @param  string  $table     Table ID or name
     * @param  string  $recordId  Record ID
     * @param  array<string, mixed>  $fields  Field name → value pairs to update
     * @return array<string, mixed>
     */
    public function updateRecord(string $baseId, string $table, string $recordId, array $fields): array
    {
        return $this->request('PATCH', "/{$baseId}/" . urlencode($table) . "/{$recordId}", [
            'fields' => $fields,
        ]);
    }

    /**
     * Delete a record from a table.
     *
     * @param  string  $baseId    Airtable base ID
     * @param  string  $table     Table ID or name
     * @param  string  $recordId  Record ID
     * @return array<string, mixed>
     */
    public function deleteRecord(string $baseId, string $table, string $recordId): array
    {
        return $this->request('DELETE', "/{$baseId}/" . urlencode($table) . "/{$recordId}");
    }

    /**
     * Upsert a record — update if a matching record exists, otherwise create.
     *
     * @param  string  $baseId    Airtable base ID
     * @param  string  $table     Table ID or name
     * @param  array<string, mixed>  $fields  Field name → value pairs
     * @param  array<string>  $fieldNamesToMergeOn  Field names used to match existing records
     * @return array<string, mixed>
     */
    public function upsertRecord(string $baseId, string $table, array $fields, array $fieldNamesToMergeOn): array
    {
        $path = "/{$baseId}/" . urlencode($table);
        $queryParams = [];
        foreach ($fieldNamesToMergeOn as $fieldName) {
            $queryParams[] = urlencode('fieldsToMergeOn[]') . '=' . urlencode($fieldName);
        }
        $path .= '?' . implode('&', $queryParams);

        return $this->requestWithQuery('PATCH', $path, [
            'performUpsert' => true,
            'fields' => $fields,
        ]);
    }

    // ── Batch Operations ────────────────────────────────────

    /**
     * Create up to 10 records in a single request.
     *
     * @param  string  $baseId  Airtable base ID
     * @param  string  $table   Table ID or name
     * @param  array<int, array<string, mixed>>  $records  Array of records, each with a "fields" key
     * @return array<string, mixed>
     */
    public function batchCreate(string $baseId, string $table, array $records): array
    {
        return $this->request('POST', "/{$baseId}/" . urlencode($table), [
            'records' => $records,
        ]);
    }

    /**
     * Update up to 10 records in a single request.
     *
     * @param  string  $baseId  Airtable base ID
     * @param  string  $table   Table ID or name
     * @param  array<int, array<string, mixed>>  $records  Array of records, each with "id" and "fields" keys
     * @return array<string, mixed>
     */
    public function batchUpdate(string $baseId, string $table, array $records): array
    {
        return $this->request('PATCH', "/{$baseId}/" . urlencode($table), [
            'records' => $records,
        ]);
    }

    /**
     * Delete up to 10 records in a single request.
     *
     * @param  string  $baseId     Airtable base ID
     * @param  string  $table      Table ID or name
     * @param  array<string>  $recordIds  Array of record IDs to delete
     * @return array<string, mixed>
     */
    public function batchDelete(string $baseId, string $table, array $recordIds): array
    {
        $path = "/{$baseId}/" . urlencode($table);
        $queryParams = [];
        foreach ($recordIds as $id) {
            $queryParams[] = 'records[]=' . urlencode($id);
        }
        $path .= '?' . implode('&', $queryParams);

        return $this->requestWithQuery('DELETE', $path);
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
     * Get the schema (tables) for a base.
     *
     * @param  string  $baseId  Airtable base ID
     * @return array<string, mixed>
     */
    public function getBaseSchema(string $baseId): array
    {
        return $this->request('GET', "/meta/bases/{$baseId}/tables");
    }

    // ── Meta: Fields ────────────────────────────────────────

    /**
     * Create a new field in a table.
     *
     * @param  string  $baseId      Airtable base ID
     * @param  string  $tableId     Table ID
     * @param  string  $name        Field name
     * @param  string  $type        Airtable field type (e.g., "singleLineText", "number", "dateTime")
     * @param  string  $description Optional field description
     * @param  array<string, mixed>  $options  Field-type-specific options
     * @return array<string, mixed>
     */
    public function createField(string $baseId, string $tableId, string $name, string $type, string $description = '', array $options = []): array
    {
        $body = [
            'name' => $name,
            'type' => $type,
        ];

        if ($description !== '') {
            $body['description'] = $description;
        }
        if (! empty($options)) {
            $body['options'] = $options;
        }

        return $this->request('POST', "/meta/bases/{$baseId}/tables/{$tableId}/fields", $body);
    }

    // ── Meta: Views ─────────────────────────────────────────

    /**
     * List views for a base.
     *
     * @param  string  $baseId  Airtable base ID
     * @return array<string, mixed>
     */
    public function listViews(string $baseId): array
    {
        return $this->request('GET', "/meta/bases/{$baseId}/views");
    }

    // ── Attachments ─────────────────────────────────────────

    /**
     * Get attachment URLs from a specific field on a record.
     *
     * @param  string  $baseId    Airtable base ID
     * @param  string  $table     Table ID or name
     * @param  string  $recordId  Record ID
     * @param  string  $field     Attachment field name
     * @return array<string, mixed>
     */
    public function getRecordAttachments(string $baseId, string $table, string $recordId, string $field): array
    {
        $record = $this->request('GET', "/{$baseId}/" . urlencode($table) . "/{$recordId}");

        $attachments = $record['fields'][$field] ?? [];

        return [
            'recordId' => $recordId,
            'field' => $field,
            'attachments' => $attachments,
        ];
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to Airtable (body params only).
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('Airtable access token is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
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
                $error = $body['error']['message'] ?? $response->body();

                Log::error("Airtable API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Airtable API error ({$response->status()}): {$error}");
            }

            return $body;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Airtable API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Airtable API: {$e->getMessage()}");
        }
    }

    /**
     * Make an API request where the path already contains query parameters.
     *
     * For endpoints that require array-style query params (e.g., records[]=recX&records[]=recY)
     * that don't serialize correctly via the HTTP client's param handling.
     *
     * @param  array<string, mixed>  $data  Body payload (for POST/PATCH)
     * @return array<string, mixed>
     */
    private function requestWithQuery(string $method, string $path, array $data = []): array
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('Airtable access token is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'PATCH'  => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            $body = $response->json() ?? [];

            if ($response->failed()) {
                $error = $body['error']['message'] ?? $response->body();

                Log::error("Airtable API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Airtable API error ({$response->status()}): {$error}");
            }

            return $body;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Airtable API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Airtable API: {$e->getMessage()}");
        }
    }
}
