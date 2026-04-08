<?php

namespace OpenCompany\Integrations\Kamatera;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KamateraService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://cloudcli.kamatera.com/api',
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
    // Account
    // ──────────────────────────────────────────────

    /**
     * Get information about the current authenticated user / account.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/account');
    }

    // ──────────────────────────────────────────────
    // Servers
    // ──────────────────────────────────────────────

    /**
     * List all servers in the account.
     *
     * @return array<string, mixed>
     */
    public function listServers(): array
    {
        return $this->request('GET', '/server');
    }

    /**
     * Get details for a single server.
     *
     * @return array<string, mixed>
     */
    public function getServer(string $id): array
    {
        return $this->request('GET', '/server/' . $id);
    }

    /**
     * Create a new server.
     *
     * @param  array<string, mixed>  $params  Server creation parameters.
     * @return array<string, mixed>
     */
    public function createServer(array $params): array
    {
        return $this->request('POST', '/server', $params);
    }

    // ──────────────────────────────────────────────
    // Networks
    // ──────────────────────────────────────────────

    /**
     * List all networks in the account.
     *
     * @return array<string, mixed>
     */
    public function listNetworks(): array
    {
        return $this->request('GET', '/network');
    }

    // ──────────────────────────────────────────────
    // Images
    // ──────────────────────────────────────────────

    /**
     * List all available images.
     *
     * @return array<string, mixed>
     */
    public function listImages(): array
    {
        return $this->request('GET', '/image');
    }

    // ──────────────────────────────────────────────
    // Datacenters
    // ──────────────────────────────────────────────

    /**
     * List all available datacenters.
     *
     * @return array<string, mixed>
     */
    public function listDatacenters(): array
    {
        return $this->request('GET', '/datacenter');
    }

    // ──────────────────────────────────────────────
    // HTTP helpers
    // ──────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g. "/server").
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
     * Make a raw HTTP request to the Kamatera API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request data.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Kamatera access token is not configured.');
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
                    Log::warning("Kamatera API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Kamatera API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('message') ?? $response->body();
                Log::error("Kamatera API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Kamatera API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Kamatera API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Kamatera API: {$e->getMessage()}");
        }
    }
}
