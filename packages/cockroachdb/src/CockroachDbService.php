<?php

namespace OpenCompany\Integrations\CockroachDb;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CockroachDbService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://cockroachlabs.cloud/api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    // ──────────────────────────────────────────────
    // Clusters
    // ──────────────────────────────────────────────

    /**
     * List all clusters the authenticated user has access to.
     *
     * @return array<string, mixed>
     */
    public function listClusters(): array
    {
        return $this->request('GET', '/clusters');
    }

    /**
     * Get details for a single cluster.
     *
     * @return array<string, mixed>
     */
    public function getCluster(string $clusterId): array
    {
        return $this->request('GET', '/clusters/' . urlencode($clusterId));
    }

    /**
     * Create a new CockroachDB cluster.
     *
     * @param  array<string, mixed>  $params  Creation parameters (name, cloud_provider, regions, etc.).
     * @return array<string, mixed>
     */
    public function createCluster(array $params): array
    {
        return $this->request('POST', '/clusters', $params);
    }

    // ──────────────────────────────────────────────
    // Databases
    // ──────────────────────────────────────────────

    /**
     * List databases in a cluster.
     *
     * @return array<string, mixed>
     */
    public function listDatabases(string $clusterId): array
    {
        return $this->request('GET', '/clusters/' . urlencode($clusterId) . '/databases');
    }

    /**
     * Get details for a specific database in a cluster.
     *
     * @return array<string, mixed>
     */
    public function getDatabase(string $clusterId, string $databaseName): array
    {
        return $this->request('GET', '/clusters/' . urlencode($clusterId) . '/databases/' . urlencode($databaseName));
    }

    // ──────────────────────────────────────────────
    // Users
    // ──────────────────────────────────────────────

    /**
     * List SQL users in a cluster.
     *
     * @return array<string, mixed>
     */
    public function listUsers(string $clusterId): array
    {
        return $this->request('GET', '/clusters/' . urlencode($clusterId) . '/users');
    }

    /**
     * Get the current authenticated user / API key info.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    // ──────────────────────────────────────────────
    // HTTP helpers
    // ──────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g. "/clusters").
     * @param  array<string, mixed>  $data  Query params (GET) or JSON body (POST/PUT/DELETE).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($method === 'DELETE') {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the CockroachDB Cloud API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request data.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('CockroachDB access token is not configured.');
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
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains((string) $contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("CockroachDB API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("CockroachDB API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('message') ?? $response->body();
                Log::error("CockroachDB API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("CockroachDB API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("CockroachDB API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to CockroachDB Cloud API: {$e->getMessage()}");
        }
    }
}
