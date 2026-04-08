<?php

namespace OpenCompany\Integrations\Convex;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Convex REST API.
 *
 * Wraps HTTP calls to Convex's cloud API for tables, documents,
 * queries, mutations, and user management.
 */
class ConvexService
{
    private const BASE_URL = 'https://api.convex.cloud/api';

    /**
     * @param  string  $accessToken  Convex API access token (bearer token)
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
     * Test the connection by listing tables.
     *
     * @return array<string, mixed>
     */
    public function testConnection(): array
    {
        return $this->listTables();
    }

    // ── Tables ──────────────────────────────────────────────

    /**
     * List all tables in the Convex deployment.
     *
     * @return array<string, mixed>
     */
    public function listTables(): array
    {
        return $this->request('GET', '/tables');
    }

    /**
     * Get metadata for a specific table including its schema.
     *
     * @param  string  $table  Table name or ID
     * @return array<string, mixed>
     */
    public function getTable(string $table): array
    {
        return $this->request('GET', "/tables/{$table}");
    }

    // ── Documents ───────────────────────────────────────────

    /**
     * Query (list) documents from a table with optional filtering and pagination.
     *
     * @param  string  $table  Table name
     * @param  array<string, mixed>  $params  Query parameters (filter, order, limit, cursor)
     * @return array<string, mixed>
     */
    public function queryDocuments(string $table, array $params = []): array
    {
        return $this->request('GET', "/tables/{$table}/documents", $params);
    }

    /**
     * Create a new document in a table.
     *
     * @param  string  $table  Table name
     * @param  array<string, mixed>  $fields  Field name → value pairs
     * @return array<string, mixed>
     */
    public function createDocument(string $table, array $fields): array
    {
        return $this->request('POST', "/tables/{$table}/documents", [
            'fields' => $fields,
        ]);
    }

    /**
     * Update an existing document (partial update).
     *
     * @param  string  $table       Table name
     * @param  string  $documentId  Document ID
     * @param  array<string, mixed>  $fields  Field name → value pairs to update
     * @return array<string, mixed>
     */
    public function updateDocument(string $table, string $documentId, array $fields): array
    {
        return $this->request('PATCH', "/tables/{$table}/documents/{$documentId}", [
            'fields' => $fields,
        ]);
    }

    /**
     * Delete a document from a table.
     *
     * @param  string  $table       Table name
     * @param  string  $documentId  Document ID
     * @return array<string, mixed>
     */
    public function deleteDocument(string $table, string $documentId): array
    {
        return $this->request('DELETE', "/tables/{$table}/documents/{$documentId}");
    }

    // ── User ────────────────────────────────────────────────

    /**
     * Get the current authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user/me');
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to Convex.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('Convex access token is not configured.');
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
                $error = $body['error']['message'] ?? $body['message'] ?? $response->body();

                Log::error("Convex API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Convex API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $body;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Convex API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Convex API: {$e->getMessage()}");
        }
    }
}
