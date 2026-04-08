<?php

namespace OpenCompany\Integrations\WpEngine;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WpEngineService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.wpengineapi.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List sites with optional pagination.
     *
     * @param  int  $limit   Number of sites per page (default 100).
     * @param  int  $page    Page number (1-indexed).
     * @return array<string, mixed>
     */
    public function listSites(int $limit = 100, int $page = 1): array
    {
        return $this->request('GET', '/sites', ['limit' => $limit, 'page' => $page]);
    }

    /**
     * Get a single site by ID.
     *
     * @param  string  $id  The site ID.
     * @return array<string, mixed>
     */
    public function getSite(string $id): array
    {
        return $this->request('GET', '/sites/' . $id);
    }

    /**
     * List installs with optional pagination.
     *
     * @param  int  $limit   Number of installs per page (default 100).
     * @param  int  $page    Page number (1-indexed).
     * @return array<string, mixed>
     */
    public function listInstalls(int $limit = 100, int $page = 1): array
    {
        return $this->request('GET', '/installs', ['limit' => $limit, 'page' => $page]);
    }

    /**
     * Get a single install by ID.
     *
     * @param  string  $id  The install ID.
     * @return array<string, mixed>
     */
    public function getInstall(string $id): array
    {
        return $this->request('GET', '/installs/' . $id);
    }

    /**
     * List domains with optional pagination.
     *
     * @param  int  $limit   Number of domains per page (default 100).
     * @param  int  $page    Page number (1-indexed).
     * @return array<string, mixed>
     */
    public function listDomains(int $limit = 100, int $page = 1): array
    {
        return $this->request('GET', '/domains', ['limit' => $limit, 'page' => $page]);
    }

    /**
     * List users with optional pagination.
     *
     * @param  int  $limit   Number of users per page (default 100).
     * @param  int  $page    Page number (1-indexed).
     * @return array<string, mixed>
     */
    public function listUsers(int $limit = 100, int $page = 1): array
    {
        return $this->request('GET', '/users', ['limit' => $limit, 'page' => $page]);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path (e.g., "/sites").
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the WP Engine API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('WP Engine access token is not configured.');
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

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("WP Engine API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("WP Engine API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("WP Engine API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("WP Engine API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("WP Engine API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to WP Engine API: {$e->getMessage()}");
        }
    }
}
