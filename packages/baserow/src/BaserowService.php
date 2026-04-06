<?php

namespace OpenCompany\Integrations\Baserow;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BaserowService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.baserow.io',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has an access token configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List rows in a database table.
     *
     * @param  int  $tableId  The Baserow table ID.
     * @param  int  $page     Page number (1-based).
     * @param  int  $size     Number of rows per page.
     * @param  array  $filters  Optional filter parameters.
     * @return array<string, mixed>
     */
    public function listTableRows(int $tableId, int $page = 1, int $size = 100, array $filters = []): array
    {
        $params = array_merge(['page' => $page, 'size' => $size], $filters);

        return $this->request('GET', "/api/database/rows/table/{$tableId}/", $params);
    }

    /**
     * Get a single row from a database table.
     *
     * @param  int  $tableId  The Baserow table ID.
     * @param  int  $rowId    The row ID.
     * @return array<string, mixed>
     */
    public function getRow(int $tableId, int $rowId): array
    {
        return $this->request('GET', "/api/database/rows/table/{$tableId}/{$rowId}/");
    }

    /**
     * Create a new row in a database table.
     *
     * @param  int  $tableId  The Baserow table ID.
     * @param  array<string, mixed>  $data  Row data as field name => value pairs.
     * @return array<string, mixed>
     */
    public function createRow(int $tableId, array $data): array
    {
        return $this->request('POST', "/api/database/rows/table/{$tableId}/", $data);
    }

    /**
     * Update an existing row in a database table.
     *
     * @param  int  $tableId  The Baserow table ID.
     * @param  int  $rowId    The row ID.
     * @param  array<string, mixed>  $data  Row data as field name => value pairs.
     * @return array<string, mixed>
     */
    public function updateRow(int $tableId, int $rowId, array $data): array
    {
        return $this->request('PATCH', "/api/database/rows/table/{$tableId}/{$rowId}/", $data);
    }

    /**
     * Delete a row from a database table.
     *
     * @param  int  $tableId  The Baserow table ID.
     * @param  int  $rowId    The row ID.
     */
    public function deleteRow(int $tableId, int $rowId): void
    {
        $this->request('DELETE', "/api/database/rows/table/{$tableId}/{$rowId}/");
    }

    /**
     * List databases (applications) in the workspace.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $size  Number of results per page.
     * @return array<string, mixed>
     */
    public function listDatabases(int $page = 1, int $size = 100): array
    {
        return $this->request('GET', '/api/applications/', ['page' => $page, 'size' => $size]);
    }

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
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Baserow API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Baserow access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Baserow API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Baserow API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('detail') ?? $body;
                Log::error("Baserow API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Baserow API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Baserow API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Baserow API: {$e->getMessage()}");
        }
    }
}
