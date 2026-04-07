<?php

namespace OpenCompany\Integrations\Fauna;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Fauna database API covering databases, collections, FQL queries, and auth.
 *
 * Wraps HTTP calls to Fauna's REST endpoints and handles authentication
 * via bearer token, request routing, and error reporting.
 */
class FaunaService
{
    /**
     * @param  string  $bearerToken  Fauna secret key (database, collection, or server key)
     * @param  string  $baseUrl      Fauna API base URL (default https://db.fauna.com)
     */
    public function __construct(
        private string $bearerToken = '',
        private string $baseUrl = 'https://db.fauna.com',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->bearerToken) && ! empty($this->baseUrl);
    }

    private function baseUrl(): string
    {
        return rtrim($this->baseUrl, '/');
    }

    // ── Databases ─────────────────────────────────────────────

    /**
     * List all databases in the current context.
     *
     * @return array<string, mixed>
     */
    public function listDatabases(): array
    {
        return $this->request('GET', '/databases');
    }

    /**
     * Get a specific database by name.
     *
     * @param  string  $name  Database name
     * @return array<string, mixed>
     */
    public function getDatabase(string $name): array
    {
        return $this->request('GET', '/databases/' . urlencode($name));
    }

    /**
     * Create a new database.
     *
     * @param  string  $name  Database name
     * @param  array<string, mixed>  $options  Optional parameters (e.g., data_col, typecheck)
     * @return array<string, mixed>
     */
    public function createDatabase(string $name, array $options = []): array
    {
        $body = array_merge(['name' => $name], $options);

        return $this->request('POST', '/databases', [], $body);
    }

    // ── Collections ───────────────────────────────────────────

    /**
     * List all collections in the current database.
     *
     * @return array<string, mixed>
     */
    public function listCollections(): array
    {
        return $this->request('GET', '/collections');
    }

    /**
     * Get a specific collection by name.
     *
     * @param  string  $name  Collection name
     * @return array<string, mixed>
     */
    public function getCollection(string $name): array
    {
        return $this->request('GET', '/collections/' . urlencode($name));
    }

    // ── FQL Query ─────────────────────────────────────────────

    /**
     * Execute an FQL (Fauna Query Language) query.
     *
     * @param  array<string, mixed>  $query  FQL query expression (array-encoded)
     * @return array<string, mixed>
     */
    public function queryFql(array $query): array
    {
        return $this->request('POST', '/query', [], [
            'query' => $query,
        ]);
    }

    // ── Auth ──────────────────────────────────────────────────

    /**
     * Get the current authenticated user/key information.
     *
     * Uses the Fauna query endpoint with an identity expression to verify
     * the current key and retrieve associated metadata.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('POST', '/query', [], [
            'query' => ['current_identity' => null],
        ]);
    }

    // ── HTTP ──────────────────────────────────────────────────

    /**
     * Make an API request to the Fauna endpoint.
     *
     * @param  string  $method        HTTP method (GET, POST, PUT, PATCH, DELETE)
     * @param  string  $path          URL path relative to the base URL
     * @param  array<string, mixed>  $queryParams  Query string parameters
     * @param  array<string, mixed>  $body         JSON body payload
     * @param  array<string, string>  $extraHeaders Additional headers
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $queryParams = [], array $body = [], array $extraHeaders = []): array
    {
        if (! $this->bearerToken) {
            throw new \RuntimeException('Fauna bearer token is not configured.');
        }

        $url = $this->baseUrl() . $path;

        try {
            $headers = array_merge([
                'Authorization' => 'Bearer ' . $this->bearerToken,
                'Content-Type' => 'application/json',
            ], $extraHeaders);

            $http = Http::withHeaders($headers)->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $queryParams),
                'POST' => $http->withQueryParameters($queryParams)->post($url, $body),
                'PUT' => $http->withQueryParameters($queryParams)->put($url, $body),
                'PATCH' => $http->withQueryParameters($queryParams)->patch($url, $body),
                'DELETE' => $http->withQueryParameters($queryParams)->delete($url, $body),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $respBody = $response->json() ?? [];
                $err = $respBody['error']['message'] ?? $respBody['message'] ?? $respBody['error'] ?? $response->body();

                Log::error("Fauna API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $err,
                ]);

                $msg = is_string($err) ? $err : json_encode($err);

                throw new \RuntimeException('Fauna API error (' . $response->status() . '): ' . $msg);
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Fauna API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException('Failed to connect to Fauna API: ' . $e->getMessage());
        }
    }
}
