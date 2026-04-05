<?php

namespace OpenCompany\Integrations\Smartsheet;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Smartsheet API client for interacting with the Smartsheet REST API v2.0.
 *
 * Handles authentication via personal access token and provides methods
 * for managing sheets, rows, columns, workspaces, search, and users.
 */
class SmartsheetService
{
    /**
     * The Smartsheet API base URL.
     */
    private const BASE_URL = 'https://api.smartsheet.com/2.0';

    /**
     * Create a new Smartsheet service instance.
     *
     * @param string $accessToken The Smartsheet personal access token for API authentication.
     */
    public function __construct(private string $accessToken = '') {}

    /**
     * Determine whether the service is properly configured with an access token.
     *
     * @return bool True if the access token is set and non-empty.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Sheets ───────────────────────────────────────────────

    /**
     * List sheets accessible to the authenticated user.
     *
     * @param int $limit  Maximum number of items to return (max 100).
     * @param int $page   Page number for pagination (1-based).
     * @return array<string, mixed> The list of sheets from the API response.
     */
    public function listSheets(int $limit = 100, int $page = 1): array
    {
        return $this->request('GET', '/sheets', [
            'pageSize' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get a single sheet by ID, including its rows and columns.
     *
     * @param int|string $sheetId  The unique identifier of the sheet.
     * @param int        $level    The nesting level for the response (0–2).
     * @param int        $pageSize Number of rows per page.
     * @param int        $page     Page number for pagination.
     * @return array<string, mixed> The sheet data including columns and rows.
     */
    public function getSheet(int|string $sheetId, int $level = 0, int $pageSize = 100, int $page = 1): array
    {
        return $this->request('GET', "/sheets/{$sheetId}", [
            'level' => $level,
            'pageSize' => $pageSize,
            'page' => $page,
        ]);
    }

    /**
     * Create a new sheet with the given name and columns.
     *
     * @param string $name    The name of the new sheet.
     * @param array  $columns Array of column definitions, each with at least 'title' and 'type'.
     * @return array<string, mixed> The created sheet data.
     */
    public function createSheet(string $name, array $columns): array
    {
        return $this->request('POST', '/sheets', [
            'name' => $name,
            'columns' => $columns,
        ]);
    }

    // ── Rows ─────────────────────────────────────────────────

    /**
     * Add one or more rows to a sheet.
     *
     * Each row should be an associative array with a 'cells' key containing
     * an array of cell objects: [{"columnId": 123, "value": "text"}].
     *
     * @param int|string $sheetId The unique identifier of the sheet.
     * @param array      $rows    Array of row objects to insert.
     * @return array<string, mixed> The result of the row insertion, including row IDs.
     */
    public function addRows(int|string $sheetId, array $rows): array
    {
        return $this->request('POST', "/sheets/{$sheetId}/rows", $rows, true);
    }

    /**
     * Update one or more existing rows in a sheet.
     *
     * Each row must include its 'id' field along with updated cell values.
     *
     * @param int|string $sheetId The unique identifier of the sheet.
     * @param array      $rows    Array of row objects with updated data.
     * @return array<string, mixed> The result of the row update operation.
     */
    public function updateRows(int|string $sheetId, array $rows): array
    {
        return $this->request('PUT', "/sheets/{$sheetId}/rows", $rows, true);
    }

    /**
     * Delete one or more rows from a sheet.
     *
     * @param int|string $sheetId The unique identifier of the sheet.
     * @param array      $rowIds  Array of row IDs to delete.
     * @return array<string, mixed> The result of the deletion operation.
     */
    public function deleteRows(int|string $sheetId, array $rowIds): array
    {
        return $this->request('DELETE', "/sheets/{$sheetId}/rows", [
            'ids' => implode(',', $rowIds),
        ]);
    }

    // ── Columns ──────────────────────────────────────────────

    /**
     * List all columns in a sheet.
     *
     * @param int|string $sheetId The unique identifier of the sheet.
     * @param int        $limit   Maximum number of columns to return.
     * @param int        $page    Page number for pagination.
     * @return array<string, mixed> The list of columns.
     */
    public function listColumns(int|string $sheetId, int $limit = 100, int $page = 1): array
    {
        return $this->request('GET', "/sheets/{$sheetId}/columns", [
            'pageSize' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Add a new column to a sheet.
     *
     * Column types include: TEXT_NUMBER, DATE, CHECKBOX, PICKLIST, CONTACT_LIST,
     * DATETIME, DURATION, ABSTRACT_DATETIME, MULTI_CONTACT_LIST, AUTO_NUMBER.
     *
     * @param int|string $sheetId The unique identifier of the sheet.
     * @param string     $title   The title for the new column.
     * @param string     $type    The column type (e.g., TEXT_NUMBER, DATE, CHECKBOX).
     * @param array|null $options Optional additional column options (e.g., 'symbol', 'options' for PICKLIST).
     * @return array<string, mixed> The created column data.
     */
    public function addColumn(int|string $sheetId, string $title, string $type, ?array $options = null): array
    {
        $data = [
            'title' => $title,
            'type' => $type,
        ];

        if ($options !== null) {
            $data = array_merge($data, $options);
        }

        return $this->request('POST', "/sheets/{$sheetId}/columns", $data, true);
    }

    // ── Workspaces ───────────────────────────────────────────

    /**
     * List all workspaces accessible to the authenticated user.
     *
     * @param int $limit Maximum number of workspaces to return.
     * @param int $page  Page number for pagination.
     * @return array<string, mixed> The list of workspaces.
     */
    public function listWorkspaces(int $limit = 100, int $page = 1): array
    {
        return $this->request('GET', '/workspaces', [
            'pageSize' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get a single workspace by ID, including its sheets and reports.
     *
     * @param int|string $workspaceId The unique identifier of the workspace.
     * @return array<string, mixed> The workspace data.
     */
    public function getWorkspace(int|string $workspaceId): array
    {
        return $this->request('GET', "/workspaces/{$workspaceId}");
    }

    // ── Search ───────────────────────────────────────────────

    /**
     * Search across sheets, reports, and templates.
     *
     * @param string      $query    The search query string.
     * @param string|null $location Optional location scope (e.g., 'sheet', 'workspace').
     * @param int         $limit    Maximum number of search results to return.
     * @return array<string, mixed> The search results.
     */
    public function search(string $query, ?string $location = null, int $limit = 100): array
    {
        $params = [
            'query' => $query,
            'pageSize' => $limit,
        ];

        if ($location !== null) {
            $params['location'] = $location;
        }

        return $this->request('GET', '/search', $params);
    }

    // ── Users ────────────────────────────────────────────────

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed> The current user's profile data.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    // ── Connection Test ──────────────────────────────────────

    /**
     * Test the API connection by fetching the current user profile.
     *
     * Used by the integration framework to verify that the configured
     * access token is valid and the Smartsheet API is reachable.
     *
     * @return array<string, mixed> The current user's profile data.
     */
    public function testConnection(): array
    {
        return $this->getCurrentUser();
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Execute an HTTP request against the Smartsheet API.
     *
     * Handles authentication, JSON encoding, error detection, and response
     * unwrapping. Smartsheet wraps responses in {"data": [...]} or {"result": {...}}.
     *
     * @param string       $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param string       $path    The API endpoint path (e.g., '/sheets').
     * @param array|string $data    Query parameters for GET/DELETE, or body payload for POST/PUT.
     * @param bool         $isBody  Whether $data should be sent as a JSON body (true) or query params (false).
     * @return array<string, mixed> The parsed API response.
     *
     * @throws \RuntimeException If the service is not configured or the API returns an error.
     */
    private function request(string $method, string $path, array|string $data = [], bool $isBody = false): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Smartsheet integration is not configured. Access token is missing.');
        }

        $url = self::BASE_URL . $path;

        $http = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->accessToken,
            'Content-Type' => 'application/json',
        ])->timeout(30);

        if ($isBody || in_array($method, ['POST', 'PUT'], true)) {
            $response = $http->$method($url, is_array($data) ? $data : []);
        } else {
            $response = $http->$method($url, is_array($data) ? $data : []);
        }

        if ($response->failed()) {
            $errorBody = $response->body();
            Log::error("Smartsheet API error [{$method} {$path}]: {$errorBody}");

            throw new \RuntimeException("Smartsheet API error: {$errorBody}");
        }

        $json = $response->json();

        // Smartsheet wraps list responses in {"data": [...]}
        // and single-item operations in {"result": {...}}
        if (is_array($json)) {
            if (isset($json['data'])) {
                return $json;
            }

            if (isset($json['result'])) {
                return is_array($json['result']) ? $json['result'] : ['result' => $json['result']];
            }
        }

        return is_array($json) ? $json : [];
    }
}
