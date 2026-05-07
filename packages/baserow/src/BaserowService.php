<?php

namespace OpenCompany\Integrations\Baserow;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Baserow REST API.
 *
 * Handles authentication, URL construction, error logging, and response parsing.
 * Tool classes delegate API communication to this service.
 */
class BaserowService
{
    /**
     * @param  string  $accessToken  Baserow database token, personal token, or JWT.
     * @param  string  $baseUrl  Baserow API base URL.
     * @param  string  $authScheme  Authorization scheme, usually Token for database tokens or JWT/Bearer for user endpoints.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.baserow.io',
        private string $authScheme = 'Token',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->authScheme = trim($this->authScheme) !== '' ? trim($this->authScheme) : 'Token';
    }

    /**
     * Check whether the service has an access token configured.
     */
    public function isConfigured(): bool
    {
        return $this->accessToken !== '';
    }

    /*
    |--------------------------------------------------------------------------
    | Applications and tables
    |--------------------------------------------------------------------------
    */

    /**
     * List databases (applications) available to the authenticated account.
     *
     * @param  int  $page  Page number.
     * @param  int  $size  Number of records per page.
     * @return array<string, mixed>
     */
    public function listDatabases(int $page = 1, int $size = 100): array
    {
        return $this->request('GET', '/api/applications/', query: [
            'page' => $page,
            'size' => $size,
        ]);
    }

    /**
     * List every table visible to the database token.
     *
     * @param  array<string, mixed>  $params  Query parameters supported by Baserow.
     * @return array<string, mixed>
     */
    public function listAllTables(array $params = []): array
    {
        return $this->request('GET', '/api/database/tables/all-tables/', query: $params);
    }

    /**
     * List tables in a specific database.
     *
     * @param  int  $databaseId  Baserow database ID.
     * @return array<string, mixed>
     */
    public function listDatabaseTables(int $databaseId): array
    {
        return $this->request('GET', "/api/database/tables/database/{$databaseId}/");
    }

    /**
     * Get metadata for a Baserow table.
     *
     * @param  int  $tableId  Baserow table ID.
     * @return array<string, mixed>
     */
    public function getTable(int $tableId): array
    {
        return $this->request('GET', "/api/database/tables/{$tableId}/");
    }

    /*
    |--------------------------------------------------------------------------
    | Fields
    |--------------------------------------------------------------------------
    */

    /**
     * List fields in a Baserow table.
     *
     * @param  int  $tableId  Baserow table ID.
     * @return array<string, mixed>
     */
    public function listFields(int $tableId): array
    {
        return $this->request('GET', "/api/database/fields/table/{$tableId}/");
    }

    /**
     * Get metadata for one field.
     *
     * @param  int  $fieldId  Baserow field ID.
     * @return array<string, mixed>
     */
    public function getField(int $fieldId): array
    {
        return $this->request('GET', "/api/database/fields/{$fieldId}/");
    }

    /**
     * Create a field in a table.
     *
     * @param  int  $tableId  Baserow table ID.
     * @param  array<string, mixed>  $payload  Field definition payload.
     * @return array<string, mixed>
     */
    public function createField(int $tableId, array $payload): array
    {
        return $this->request('POST', "/api/database/fields/table/{$tableId}/", body: $payload);
    }

    /**
     * Update a field definition.
     *
     * @param  int  $fieldId  Baserow field ID.
     * @param  array<string, mixed>  $payload  Field update payload.
     * @return array<string, mixed>
     */
    public function updateField(int $fieldId, array $payload): array
    {
        return $this->request('PATCH', "/api/database/fields/{$fieldId}/", body: $payload);
    }

    /**
     * Delete a field definition.
     *
     * @param  int  $fieldId  Baserow field ID.
     * @return array<string, mixed>
     */
    public function deleteField(int $fieldId): array
    {
        return $this->request('DELETE', "/api/database/fields/{$fieldId}/");
    }

    /*
    |--------------------------------------------------------------------------
    | Rows
    |--------------------------------------------------------------------------
    */

    /**
     * List rows in a table using page/size pagination.
     *
     * @param  int  $tableId  Baserow table ID.
     * @param  int  $page  Page number.
     * @param  int  $size  Number of rows per page.
     * @param  array<string, mixed>  $filters  Optional Baserow filter parameters.
     * @return array<string, mixed>
     */
    public function listTableRows(int $tableId, int $page = 1, int $size = 100, array $filters = []): array
    {
        return $this->listRows($tableId, array_merge([
            'page' => $page,
            'size' => $size,
        ], $filters));
    }

    /**
     * List rows in a table using Baserow query parameters.
     *
     * @param  int  $tableId  Baserow table ID.
     * @param  array<string, mixed>  $params  Query parameters such as page, size, search, order_by, filters, and user_field_names.
     * @return array<string, mixed>
     */
    public function listRows(int $tableId, array $params = []): array
    {
        return $this->request('GET', "/api/database/rows/table/{$tableId}/", query: $params);
    }

    /**
     * Get a single row from a database table.
     *
     * @param  int  $tableId  Baserow table ID.
     * @param  int  $rowId  Row ID.
     * @param  array<string, mixed>  $params  Optional query parameters such as user_field_names.
     * @return array<string, mixed>
     */
    public function getRow(int $tableId, int $rowId, array $params = []): array
    {
        return $this->request('GET', "/api/database/rows/table/{$tableId}/{$rowId}/", query: $params);
    }

    /**
     * Create a row in a table.
     *
     * @param  int  $tableId  Baserow table ID.
     * @param  array<string, mixed>  $data  Row field values.
     * @param  array<string, mixed>  $query  Optional query parameters such as user_field_names.
     * @return array<string, mixed>
     */
    public function createRow(int $tableId, array $data, array $query = []): array
    {
        return $this->request('POST', "/api/database/rows/table/{$tableId}/", query: $query, body: $data);
    }

    /**
     * Update a row in a table.
     *
     * @param  int  $tableId  Baserow table ID.
     * @param  int  $rowId  Row ID.
     * @param  array<string, mixed>  $data  Row field values.
     * @param  array<string, mixed>  $query  Optional query parameters such as user_field_names.
     * @return array<string, mixed>
     */
    public function updateRow(int $tableId, int $rowId, array $data, array $query = []): array
    {
        return $this->request('PATCH', "/api/database/rows/table/{$tableId}/{$rowId}/", query: $query, body: $data);
    }

    /**
     * Move a row before another row or to the end of the table.
     *
     * @param  int  $tableId  Baserow table ID.
     * @param  int  $rowId  Row ID.
     * @param  array<string, mixed>  $query  Move query parameters such as before_id.
     * @return array<string, mixed>
     */
    public function moveRow(int $tableId, int $rowId, array $query = []): array
    {
        return $this->request('PATCH', "/api/database/rows/table/{$tableId}/{$rowId}/move/", query: $query);
    }

    /**
     * Delete a row from a table.
     *
     * @param  int  $tableId  Baserow table ID.
     * @param  int  $rowId  Row ID.
     * @return array<string, mixed>
     */
    public function deleteRow(int $tableId, int $rowId): array
    {
        return $this->request('DELETE', "/api/database/rows/table/{$tableId}/{$rowId}/");
    }

    /**
     * Batch-create rows in a table.
     *
     * @param  int  $tableId  Baserow table ID.
     * @param  array<int, array<string, mixed>>  $items  Row payloads.
     * @param  array<string, mixed>  $query  Optional query parameters.
     * @return array<string, mixed>
     */
    public function batchCreate(int $tableId, array $items, array $query = []): array
    {
        return $this->request('POST', "/api/database/rows/table/{$tableId}/batch/", query: $query, body: $this->wrapItems($items));
    }

    /**
     * Batch-update rows in a table.
     *
     * @param  int  $tableId  Baserow table ID.
     * @param  array<int, array<string, mixed>>  $items  Row payloads including each row id.
     * @param  array<string, mixed>  $query  Optional query parameters.
     * @return array<string, mixed>
     */
    public function batchUpdate(int $tableId, array $items, array $query = []): array
    {
        return $this->request('PATCH', "/api/database/rows/table/{$tableId}/batch/", query: $query, body: $this->wrapItems($items));
    }

    /**
     * Batch-delete rows in a table.
     *
     * @param  int  $tableId  Baserow table ID.
     * @param  array<int, int|string>  $rowIds  Row IDs to delete.
     * @return array<string, mixed>
     */
    public function batchDelete(int $tableId, array $rowIds): array
    {
        return $this->request('DELETE', "/api/database/rows/table/{$tableId}/batch/", body: $this->wrapItems($rowIds));
    }

    /*
    |--------------------------------------------------------------------------
    | User and raw API helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/user/');
    }

    /**
     * Perform a raw GET request to a relative Baserow API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, query: $query);
    }

    /**
     * Perform a raw POST request to a relative Baserow API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = [], array $query = []): array
    {
        return $this->request('POST', $path, query: $query, body: $payload);
    }

    /**
     * Perform a raw PATCH request to a relative Baserow API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = [], array $query = []): array
    {
        return $this->request('PATCH', $path, query: $query, body: $payload);
    }

    /**
     * Perform a raw DELETE request to a relative Baserow API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $payload = [], array $query = []): array
    {
        return $this->request('DELETE', $path, query: $query, body: $payload);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Baserow API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON body.
     * @return Response
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Baserow access token is not configured.');
        }

        $url = $this->buildUrl($path, $query);

        try {
            $http = Http::withHeaders([
                'Authorization' => $this->authScheme . ' ' . $this->accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'PATCH' => $http->patch($url, $body),
                'DELETE' => $http->delete($url, $body),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Baserow API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Baserow API: {$e->getMessage()}");
        }
    }

    /**
     * Build a safe URL for a relative API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return string
     */
    private function buildUrl(string $path, array $query = []): string
    {
        if (preg_match('/^https?:\/\//i', $path) === 1 || str_contains($path, '..')) {
            throw new RuntimeException('Baserow API path must be a safe relative path.');
        }

        $path = '/' . ltrim($path, '/');
        $queryString = $this->buildQuery($query);

        return $this->baseUrl . $path . ($queryString !== '' ? '?' . $queryString : '');
    }

    /**
     * Build a query string while preserving repeated array parameters.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function buildQuery(array $query): string
    {
        $pairs = [];

        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }

            if (is_array($value)) {
                foreach ($value as $item) {
                    $pairs[] = rawurlencode((string) $key) . '=' . rawurlencode(is_scalar($item) ? (string) $item : json_encode($item, JSON_THROW_ON_ERROR));
                }
                continue;
            }

            $pairs[] = rawurlencode((string) $key) . '=' . rawurlencode((string) $value);
        }

        return implode('&', $pairs);
    }

    /**
     * Normalize batch request bodies to Baserow's items wrapper.
     *
     * @param  array<int|string, mixed>  $items  Batch items or already wrapped body.
     * @return array<string, mixed>
     */
    private function wrapItems(array $items): array
    {
        if (array_key_exists('items', $items) && is_array($items['items'])) {
            return $items;
        }

        return ['items' => array_values($items)];
    }

    /**
     * Throw a normalized exception for Baserow API failures.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Relative API path.
     * @param  Response  $response  Failed HTTP response.
     *
     * @throws RuntimeException
     */
    private function throwApiError(string $method, string $path, Response $response): void
    {
        $contentType = $response->header('Content-Type');
        $body = $response->body();

        if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
            Log::warning("Baserow API returned HTML for {$method} {$path}", [
                'status' => $response->status(),
            ]);

            throw new RuntimeException("Baserow API endpoint not available (HTTP {$response->status()}). Check the API URL and path.");
        }

        $error = $response->json('error') ?? $response->json('detail') ?? $body;
        Log::error("Baserow API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new RuntimeException("Baserow API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }
}
