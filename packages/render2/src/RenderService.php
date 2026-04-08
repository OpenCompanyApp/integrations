<?php

namespace OpenCompany\Integrations\Render2;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RenderService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.render.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    // ──────────────────────────────────────────────
    // Services
    // ──────────────────────────────────────────────

    /**
     * List all services in the account.
     *
     * @param  int|null  $limit  Number of items per page (max 100).
     * @param  string|null  $cursor  Pagination cursor.
     * @return array<string, mixed>
     */
    public function listServices(?int $limit = null, ?string $cursor = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }

        return $this->request('GET', '/services', $params);
    }

    /**
     * Get details for a single service.
     *
     * @return array<string, mixed>
     */
    public function getService(string $serviceId): array
    {
        return $this->request('GET', '/services/' . urlencode($serviceId));
    }

    /**
     * Create a new service.
     *
     * @param  array<string, mixed>  $params  Creation parameters (type, name, repo, etc.).
     * @return array<string, mixed>
     */
    public function createService(array $params): array
    {
        return $this->request('POST', '/services', $params);
    }

    // ──────────────────────────────────────────────
    // Deploys
    // ──────────────────────────────────────────────

    /**
     * List deploys for a service.
     *
     * @return array<string, mixed>
     */
    public function listDeploys(string $serviceId, ?int $limit = null, ?string $cursor = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }

        return $this->request('GET', '/services/' . urlencode($serviceId) . '/deploys', $params);
    }

    /**
     * Get details for a specific deploy.
     *
     * @return array<string, mixed>
     */
    public function getDeploy(string $deployId): array
    {
        return $this->request('GET', '/deploys/' . urlencode($deployId));
    }

    // ──────────────────────────────────────────────
    // Jobs
    // ──────────────────────────────────────────────

    /**
     * List jobs for a service.
     *
     * @return array<string, mixed>
     */
    public function listJobs(string $serviceId, ?int $limit = null, ?string $cursor = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }

        return $this->request('GET', '/services/' . urlencode($serviceId) . '/jobs', $params);
    }

    // ──────────────────────────────────────────────
    // User
    // ──────────────────────────────────────────────

    /**
     * Get information about the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/owners/me');
    }

    // ──────────────────────────────────────────────
    // HTTP helpers
    // ──────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g. "/services").
     * @param  array<string, mixed>  $data  Query params (GET) or JSON body (POST/PUT/DELETE).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Render API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request data.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Render API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
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
                    Log::warning("Render API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Render API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('message') ?? $response->body();
                Log::error("Render API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Render API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Render API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Render API: {$e->getMessage()}");
        }
    }
}
