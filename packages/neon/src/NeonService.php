<?php

namespace OpenCompany\Integrations\Neon;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NeonService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://console.neon.tech/api/v2',
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
    // Projects
    // ──────────────────────────────────────────────

    /**
     * List all projects the authenticated user has access to.
     *
     * @return array<string, mixed>
     */
    public function listProjects(): array
    {
        return $this->request('GET', '/projects');
    }

    /**
     * Get details for a single project.
     *
     * @return array<string, mixed>
     */
    public function getProject(string $projectId): array
    {
        return $this->request('GET', '/projects/' . urlencode($projectId));
    }

    /**
     * Create a new Neon project.
     *
     * @param  array<string, mixed>  $params  Creation parameters (name, region_id, etc.).
     * @return array<string, mixed>
     */
    public function createProject(array $params): array
    {
        return $this->request('POST', '/projects', $params);
    }

    // ──────────────────────────────────────────────
    // Branches
    // ──────────────────────────────────────────────

    /**
     * List branches in a project.
     *
     * @return array<string, mixed>
     */
    public function listBranches(string $projectId): array
    {
        return $this->request('GET', '/projects/' . urlencode($projectId) . '/branches');
    }

    /**
     * Get details for a specific branch in a project.
     *
     * @return array<string, mixed>
     */
    public function getBranch(string $projectId, string $branchId): array
    {
        return $this->request('GET', '/projects/' . urlencode($projectId) . '/branches/' . urlencode($branchId));
    }

    // ──────────────────────────────────────────────
    // Databases
    // ──────────────────────────────────────────────

    /**
     * List databases in a project's branch.
     *
     * @return array<string, mixed>
     */
    public function listDatabases(string $projectId, string $branchId): array
    {
        return $this->request('GET', '/projects/' . urlencode($projectId) . '/branches/' . urlencode($branchId) . '/databases');
    }

    // ──────────────────────────────────────────────
    // Users
    // ──────────────────────────────────────────────

    /**
     * Get the current authenticated user info.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    // ──────────────────────────────────────────────
    // HTTP helpers
    // ──────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g. "/projects").
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
     * Make a raw HTTP request to the Neon API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request data.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Neon access token is not configured.');
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
                    Log::warning("Neon API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Neon API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('message') ?? $response->body();
                Log::error("Neon API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Neon API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Neon API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Neon API: {$e->getMessage()}");
        }
    }
}
