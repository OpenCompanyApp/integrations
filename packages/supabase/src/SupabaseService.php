<?php

namespace OpenCompany\Integrations\Supabase;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Supabase PostgREST API covering tables, rows, RPC, SQL queries, and auth.
 *
 * Wraps HTTP calls to Supabase's REST v1 endpoints and handles authentication
 * via apikey header and bearer token, request routing, and error reporting.
 */
class SupabaseService
{
    /**
     * @param  string  $apiKey       Supabase anon key or service_role key
     * @param  string  $projectUrl   Supabase project URL (e.g., https://xyzproject.supabase.co)
     * @param  string  $bearerToken  Optional bearer token; defaults to apiKey when empty
     */
    public function __construct(
        private string $apiKey = '',
        private string $projectUrl = '',
        private string $bearerToken = '',
    ) {
        if (empty($this->bearerToken)) {
            $this->bearerToken = $this->apiKey;
        }
    }

    public function isConfigured(): bool
    {
        return ! empty($this->apiKey) && ! empty($this->projectUrl);
    }

    /**
     * Get the base REST URL for the project.
     *
     * @return string
     */
    private function baseUrl(): string
    {
        return rtrim($this->projectUrl, '/') . '/rest/v1';
    }

    // ── Rows ───────────────────────────────────────────────

    /**
     * List rows from a table with optional filtering, ordering, and pagination.
     *
     * @param  string  $table    Table name
     * @param  string  $select   Comma-separated column names (default "*")
     * @param  array<string, mixed>  $filter  Query filter params (e.g., ["column" => "eq.value"])
     * @param  string  $order    Order clause (e.g., "created_at.desc")
     * @param  int|null  $limit  Maximum number of rows to return
     * @param  int|null  $offset Number of rows to skip
     * @param  string|null  $count  Count mode: "exact" or "planned" or null
     * @return array<string, mixed>
     */
    public function listRows(string $table, string $select = '*', array $filter = [], string $order = '', ?int $limit = null, ?int $offset = null, ?string $count = null): array
    {
        $params = array_merge($filter, ['select' => $select]);

        if ($order !== '') {
            $params['order'] = $order;
        }
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($offset !== null) {
            $params['offset'] = $offset;
        }

        $headers = [];
        if ($count !== null) {
            $headers['Prefer'] = 'count=' . $count;
        }

        return $this->request('GET', '/' . urlencode($table), $params, [], $headers);
    }

    /**
     * Get a single row by its primary key id.
     *
     * @param  string  $table   Table name
     * @param  string  $id      Primary key value
     * @param  string  $select  Comma-separated column names (default "*")
     * @return array<string, mixed>
     */
    public function getRow(string $table, string $id, string $select = '*'): array
    {
        return $this->request('GET', '/' . urlencode($table), [
            'id' => 'eq.' . $id,
            'select' => $select,
        ]);
    }

    /**
     * Insert a single row into a table.
     *
     * @param  string  $table      Table name
     * @param  array<string, mixed>  $data  Column name → value pairs
     * @param  string  $returning  Return mode: "representation" or "minimal"
     * @param  bool  $upsert       Whether to perform an upsert on conflict
     * @return array<string, mixed>
     */
    public function insertRow(string $table, array $data, string $returning = 'representation', bool $upsert = false): array
    {
        $prefer = 'return=' . $returning;
        if ($upsert) {
            $prefer .= ',resolution=merge-duplicates';
        }

        return $this->request('POST', '/' . urlencode($table), [], $data, [
            'Prefer' => $prefer,
        ]);
    }

    /**
     * Update a row by its primary key id.
     *
     * @param  string  $table      Table name
     * @param  string  $id         Primary key value
     * @param  array<string, mixed>  $data  Column name → value pairs to update
     * @param  string  $returning  Return mode: "representation" or "minimal"
     * @return array<string, mixed>
     */
    public function updateRow(string $table, string $id, array $data, string $returning = 'representation'): array
    {
        return $this->request('PATCH', '/' . urlencode($table) . '?id=eq.' . urlencode($id), [], $data, [
            'Prefer' => 'return=' . $returning,
        ]);
    }

    /**
     * Delete a row by its primary key id.
     *
     * @param  string  $table      Table name
     * @param  string  $id         Primary key value
     * @param  string  $returning  Return mode: "representation" or "minimal"
     * @return array<string, mixed>
     */
    public function deleteRow(string $table, string $id, string $returning = 'representation'): array
    {
        return $this->request('DELETE', '/' . urlencode($table) . '?id=eq.' . urlencode($id), [], [], [
            'Prefer' => 'return=' . $returning,
        ]);
    }

    /**
     * Insert multiple rows in a single batch request.
     *
     * @param  string  $table      Table name
     * @param  array<int, array<string, mixed>>  $records  Array of row data
     * @param  string  $returning  Return mode: "representation" or "minimal"
     * @param  bool  $upsert       Whether to perform an upsert on conflict
     * @return array<string, mixed>
     */
    public function insertBatch(string $table, array $records, string $returning = 'representation', bool $upsert = false): array
    {
        $prefer = 'return=' . $returning;
        if ($upsert) {
            $prefer .= ',resolution=merge-duplicates';
        }

        return $this->request('POST', '/' . urlencode($table), [], $records, [
            'Prefer' => $prefer,
        ]);
    }

    // ── Upsert ─────────────────────────────────────────────

    /**
     * Upsert a row — insert or merge on conflict.
     *
     * @param  string  $table        Table name
     * @param  array<string, mixed>  $data  Column name → value pairs
     * @param  string  $onConflict   Comma-separated column names that define the unique constraint
     * @param  string  $returning    Return mode: "representation" or "minimal"
     * @return array<string, mixed>
     */
    public function upsertRow(string $table, array $data, string $onConflict = '', string $returning = 'representation'): array
    {
        $queryParams = [];
        if ($onConflict !== '') {
            $queryParams['on_conflict'] = $onConflict;
        }

        $path = '/' . urlencode($table);
        if (! empty($queryParams)) {
            $path .= '?' . http_build_query($queryParams);
        }

        return $this->request('POST', $path, [], $data, [
            'Prefer' => 'return=' . $returning . ',resolution=merge-duplicates',
        ]);
    }

    // ── RPC ────────────────────────────────────────────────

    /**
     * Call a remote procedure (RPC function).
     *
     * @param  string  $function  Function name
     * @param  array<string, mixed>  $params  Parameters to pass to the function
     * @return array<string, mixed>
     */
    public function rpc(string $function, array $params = []): array
    {
        return $this->request('POST', '/rpc/' . urlencode($function), [], $params);
    }

    // ── Schema Discovery ───────────────────────────────────

    /**
     * List available tables via the OpenAPI spec endpoint.
     *
     * @return array<string, mixed>
     */
    public function listTables(): array
    {
        return $this->request('GET', '/', [], [], [
            'Accept' => 'application/json',
        ]);
    }

    // ── Count ──────────────────────────────────────────────

    /**
     * Count rows in a table, optionally filtered.
     *
     * Returns the count from the Content-Range header when using Prefer: count=exact.
     *
     * @param  string  $table    Table name
     * @param  array<string, mixed>  $filter  Query filter params
     * @return array<string, mixed>
     */
    public function countRows(string $table, array $filter = []): array
    {
        $params = array_merge($filter, ['select' => 'count']);

        return $this->request('GET', '/' . urlencode($table), $params, [], [
            'Prefer' => 'count=exact',
        ]);
    }

    // ── SQL Query ──────────────────────────────────────────

    /**
     * Execute a raw SQL query via the exec_sql RPC function.
     *
     * Note: This requires the exec_sql function to be defined in the Supabase database.
     *
     * @param  string  $query  SQL query string
     * @return array<string, mixed>
     */
    public function querySql(string $query): array
    {
        return $this->rpc('exec_sql', ['query' => $query]);
    }

    // ── Auth ───────────────────────────────────────────────

    /**
     * Get the current authenticated user from the Supabase Auth API.
     *
     * Uses the service_role key to fetch user details from the auth endpoint.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('Supabase API key is not configured.');
        }
        if (! $this->projectUrl) {
            throw new \RuntimeException('Supabase project URL is not configured.');
        }

        $url = rtrim($this->projectUrl, '/') . '/auth/v1/user';

        try {
            $response = Http::withHeaders([
                'apikey' => $this->apiKey,
                'Authorization' => 'Bearer ' . $this->bearerToken,
                'Content-Type' => 'application/json',
            ])->timeout(30)->get($url);

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $err = $body['msg'] ?? $body['message'] ?? $body['error_description'] ?? $response->body();

                Log::error('Supabase Auth API error: GET /auth/v1/user', [
                    'status' => $response->status(),
                    'error' => $err,
                ]);

                $msg = is_string($err) ? $err : json_encode($err);

                throw new \RuntimeException('Supabase Auth API error (' . $response->status() . '): ' . $msg);
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Supabase Auth API connection error', [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException('Failed to connect to Supabase Auth API: ' . $e->getMessage());
        }
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request to the Supabase PostgREST endpoint.
     *
     * @param  string  $method        HTTP method (GET, POST, PATCH, DELETE)
     * @param  string  $path          URL path relative to the REST base URL
     * @param  array<string, mixed>  $queryParams  Query string parameters
     * @param  array<string, mixed>  $body         JSON body payload
     * @param  array<string, string>  $extraHeaders Additional headers (e.g., Prefer)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $queryParams = [], array $body = [], array $extraHeaders = []): array
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('Supabase API key is not configured.');
        }
        if (! $this->projectUrl) {
            throw new \RuntimeException('Supabase project URL is not configured.');
        }

        $url = $this->baseUrl() . $path;

        try {
            $headers = array_merge([
                'apikey' => $this->apiKey,
                'Authorization' => 'Bearer ' . $this->bearerToken,
                'Content-Type' => 'application/json',
            ], $extraHeaders);

            $http = Http::withHeaders($headers)->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $queryParams),
                'POST' => $http->withQueryParameters($queryParams)->post($url, $body),
                'PATCH' => $http->withQueryParameters($queryParams)->patch($url, $body),
                'DELETE' => $http->withQueryParameters($queryParams)->delete($url, $body),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $respBody = $response->json() ?? [];
                $err = $respBody['message'] ?? $respBody['msg'] ?? $respBody['details'] ?? $response->body();

                Log::error("Supabase API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $err,
                ]);

                $msg = is_string($err) ? $err : json_encode($err);

                throw new \RuntimeException('Supabase API error (' . $response->status() . '): ' . $msg);
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Supabase API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException('Failed to connect to Supabase API: ' . $e->getMessage());
        }
    }
}
