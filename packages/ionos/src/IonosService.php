<?php

namespace OpenCompany\Integrations\Ionos;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IonosService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.ionos.com/cloudapi/v6',
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
     * Get information about the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/um/users/own');
    }

    // ──────────────────────────────────────────────
    // Servers
    // ──────────────────────────────────────────────

    /**
     * List all servers in the datacenter.
     *
     * @return array<string, mixed>
     */
    public function listServers(): array
    {
        return $this->request('GET', '/servers');
    }

    /**
     * Get details for a single server.
     *
     * @return array<string, mixed>
     */
    public function getServer(string $serverId): array
    {
        return $this->request('GET', '/servers/' . $serverId);
    }

    // ──────────────────────────────────────────────
    // Volumes
    // ──────────────────────────────────────────────

    /**
     * List all volumes.
     *
     * @return array<string, mixed>
     */
    public function listVolumes(): array
    {
        return $this->request('GET', '/volumes');
    }

    // ──────────────────────────────────────────────
    // LANs
    // ──────────────────────────────────────────────

    /**
     * List all LANs.
     *
     * @return array<string, mixed>
     */
    public function listLans(): array
    {
        return $this->request('GET', '/lans');
    }

    // ──────────────────────────────────────────────
    // NICs
    // ──────────────────────────────────────────────

    /**
     * List all NICs.
     *
     * @return array<string, mixed>
     */
    public function listNics(): array
    {
        return $this->request('GET', '/nics');
    }

    // ──────────────────────────────────────────────
    // Images
    // ──────────────────────────────────────────────

    /**
     * List all images.
     *
     * @return array<string, mixed>
     */
    public function listImages(): array
    {
        return $this->request('GET', '/images');
    }

    // ──────────────────────────────────────────────
    // HTTP helpers
    // ──────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g. "/servers").
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
     * Make a raw HTTP request to the IONOS Cloud API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request data.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('IONOS access token is not configured.');
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
                    Log::warning("IONOS API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("IONOS API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('message') ?? $response->body();
                Log::error("IONOS API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("IONOS API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("IONOS API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to IONOS API: {$e->getMessage()}");
        }
    }
}
