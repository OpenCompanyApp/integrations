<?php

namespace OpenCompany\Integrations\Airtable;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Airtable Web API.
 *
 * Handles bearer-token authentication, request dispatch, error logging, and
 * response parsing for records, metadata, comments, and webhooks.
 */
class AirtableService
{
    /**
     * @param  string  $accessToken  Airtable Personal Access Token or OAuth access token.
     * @param  string  $baseUrl  Airtable Web API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.airtable.com/v0',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->accessToken !== '';
    }

    /**
     * Test the connection by returning the authenticated user.
     *
     * @return array<string, mixed>
     */
    public function testConnection(): array
    {
        return $this->apiGet('/whoami');
    }

    /**
     * List records from a table.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listRecords(string $baseId, string $table, array $params = []): array
    {
        return $this->apiGet("/{$baseId}/" . rawurlencode($table), $params);
    }

    /**
     * Get a single record by ID.
     *
     * @return array<string, mixed>
     */
    public function getRecord(string $baseId, string $table, string $recordId): array
    {
        return $this->apiGet("/{$baseId}/" . rawurlencode($table) . "/{$recordId}");
    }

    /**
     * Create a new record in a table.
     *
     * @param  array<string, mixed>  $fields  Field values.
     * @return array<string, mixed>
     */
    public function createRecord(string $baseId, string $table, array $fields): array
    {
        return $this->apiPost("/{$baseId}/" . rawurlencode($table), ['fields' => $fields]);
    }

    /**
     * Update one record.
     *
     * @param  array<string, mixed>  $fields  Field values.
     * @return array<string, mixed>
     */
    public function updateRecord(string $baseId, string $table, string $recordId, array $fields): array
    {
        return $this->apiPatch("/{$baseId}/" . rawurlencode($table) . "/{$recordId}", ['fields' => $fields]);
    }

    /**
     * Delete one record.
     *
     * @return array<string, mixed>
     */
    public function deleteRecord(string $baseId, string $table, string $recordId): array
    {
        return $this->apiDelete("/{$baseId}/" . rawurlencode($table) . "/{$recordId}");
    }

    /**
     * List all bases the token has access to.
     *
     * @return array<string, mixed>
     */
    public function listBases(): array
    {
        return $this->apiGet('/meta/bases');
    }

    /**
     * Get schema metadata for a base.
     *
     * @return array<string, mixed>
     */
    public function getBaseSchema(string $baseId): array
    {
        return $this->apiGet("/meta/bases/{$baseId}/tables");
    }

    /**
     * Get a single base from the accessible base list.
     *
     * @return array<string, mixed>
     */
    public function getBase(string $baseId): array
    {
        return $this->apiGet("/meta/bases/{$baseId}");
    }

    /**
     * Get the currently authenticated Airtable user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->apiGet('/whoami');
    }

    /**
     * Create a field in a table.
     *
     * @param  array<string, mixed>  $data  Field creation payload.
     * @return array<string, mixed>
     */
    public function createField(string $baseId, string $tableId, array $data): array
    {
        return $this->apiPost("/meta/bases/{$baseId}/tables/{$tableId}/fields", $data);
    }

    /**
     * List views by reading base schema and returning table view metadata.
     *
     * @return array<string, mixed>
     */
    public function listViews(string $baseId): array
    {
        $schema = $this->getBaseSchema($baseId);
        $views = [];

        foreach ($schema['tables'] ?? [] as $table) {
            foreach ($table['views'] ?? [] as $view) {
                $views[] = [
                    'table_id' => $table['id'] ?? null,
                    'table_name' => $table['name'] ?? null,
                    'view' => $view,
                ];
            }
        }

        return ['views' => $views];
    }

    /**
     * Send a GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, $query);
    }

    /**
     * Send a POST request.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $data = [], array $query = []): array
    {
        return $this->request('POST', $path, $data, $query);
    }

    /**
     * Send a PATCH request.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $data = [], array $query = []): array
    {
        return $this->request('PATCH', $path, $data, $query);
    }

    /**
     * Send a DELETE request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $path, $query);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Query params for GET/DELETE or body for mutating requests.
     * @param  array<string, mixed>  $query  Query params for mutating requests.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], array $query = []): array
    {
        $response = $this->rawRequest($method, $path, $data, $query);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to Airtable.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $query
     */
    private function rawRequest(string $method, string $path, array $data = [], array $query = []): Response
    {
        if ($this->accessToken === '') {
            throw new RuntimeException('Airtable access token is not configured.');
        }

        $url = $this->baseUrl . '/' . ltrim($path, '/');

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
            ])
                ->acceptJson()
                ->asJson()
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->withOptions(['query' => $query])->post($url, $data),
                'PATCH' => $http->withOptions(['query' => $query])->patch($url, $data),
                'DELETE' => $http->withOptions(['query' => $data])->delete($url),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->failed()) {
                $body = $response->json() ?? [];
                $error = $body['error']['message'] ?? $body['error']['type'] ?? $response->body();

                Log::error("Airtable API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException('Airtable API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Airtable API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException("Failed to connect to Airtable API: {$e->getMessage()}");
        }
    }
}
