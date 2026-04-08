<?php

namespace OpenCompany\Integrations\Supabase;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SupabaseService
{
    /**
     * Create a new Supabase service instance.
     *
     * @param string $accessToken The Supabase access token (used as Bearer auth).
     * @param string $baseUrl     The Supabase Management API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.supabase.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured.
     *
     * @return bool True if the access token is set.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all projects in the organization.
     *
     * @return array The parsed JSON response containing projects.
     */
    public function listProjects(): array
    {
        return $this->request('GET', '/projects');
    }

    /**
     * Get a project by its ID.
     *
     * @param  string $id The project reference ID.
     * @return array The parsed JSON response containing the project.
     */
    public function getProject(string $id): array
    {
        return $this->request('GET', '/projects/' . urlencode($id));
    }

    /**
     * List all tables in a project.
     *
     * @param  string $projectRef The project reference ID.
     * @return array The parsed JSON response containing tables.
     */
    public function listTables(string $projectRef): array
    {
        return $this->request('GET', '/projects/' . urlencode($projectRef) . '/tables');
    }

    /**
     * Get a table by its ID in a project.
     *
     * @param  string $projectRef The project reference ID.
     * @param  string $tableId    The table ID.
     * @return array The parsed JSON response containing the table.
     */
    public function getTable(string $projectRef, string $tableId): array
    {
        return $this->request('GET', '/projects/' . urlencode($projectRef) . '/tables/' . urlencode($tableId));
    }

    /**
     * List rows in a table.
     *
     * @param  string $projectRef The project reference ID.
     * @param  string $tableName  The table name or ID.
     * @param  array  $params     Query parameters: limit, offset, select, order.
     * @return array The parsed JSON response containing rows.
     */
    public function listRows(string $projectRef, string $tableName, array $params = []): array
    {
        return $this->request('GET', '/projects/' . urlencode($projectRef) . '/tables/' . urlencode($tableName) . '/rows', $params);
    }

    /**
     * Get a single row by its ID.
     *
     * @param  string $projectRef The project reference ID.
     * @param  string $tableName  The table name or ID.
     * @param  string $rowId      The row ID.
     * @return array The parsed JSON response containing the row.
     */
    public function getRow(string $projectRef, string $tableName, string $rowId): array
    {
        return $this->request('GET', '/projects/' . urlencode($projectRef) . '/tables/' . urlencode($tableName) . '/rows/' . urlencode($rowId));
    }

    /**
     * Get the currently authenticated user profile.
     *
     * @return array The parsed JSON response containing the user profile.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/profile');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string $method The HTTP method (GET, POST, PUT, DELETE).
     * @param  string $path   The API endpoint path.
     * @param  array  $data   Request data (query params for GET, body for POST/PUT).
     * @return array The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Supabase Management API.
     *
     * @param  string $method The HTTP method (GET, POST, PUT, DELETE).
     * @param  string $path   The API endpoint path.
     * @param  array  $data   Request data (query params for GET, body for POST/PUT).
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the access token is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Supabase access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withToken($this->accessToken)
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $json = $response->json();
                $error = $json['message'] ?? $json['msg'] ?? $response->body();

                Log::error("Supabase API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Supabase API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Supabase API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Supabase API: {$e->getMessage()}");
        }
    }
}
