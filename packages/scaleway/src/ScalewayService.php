<?php

namespace OpenCompany\Integrations\Scaleway;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ScalewayService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.scaleway.com/instance/v1/zones/fr-par-1',
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
        return $this->request('GET', '', [], 'https://api.scaleway.com/account/v2');
    }

    // ──────────────────────────────────────────────
    // Servers
    // ──────────────────────────────────────────────

    /**
     * List all servers in the zone.
     *
     * @param  int|null  $page  Page number (1-based).
     * @param  int|null  $perPage  Number of items per page.
     * @return array<string, mixed>
     */
    public function listServers(?int $page = null, ?int $perPage = null): array
    {
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }

        return $this->request('GET', '/servers', $params);
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
     * List all volumes in the zone.
     *
     * @param  int|null  $page  Page number (1-based).
     * @param  int|null  $perPage  Number of items per page.
     * @return array<string, mixed>
     */
    public function listVolumes(?int $page = null, ?int $perPage = null): array
    {
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }

        return $this->request('GET', '/volumes', $params);
    }

    // ──────────────────────────────────────────────
    // Snapshots
    // ──────────────────────────────────────────────

    /**
     * List all snapshots in the zone.
     *
     * @param  int|null  $page  Page number (1-based).
     * @param  int|null  $perPage  Number of items per page.
     * @return array<string, mixed>
     */
    public function listSnapshots(?int $page = null, ?int $perPage = null): array
    {
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }

        return $this->request('GET', '/snapshots', $params);
    }

    // ──────────────────────────────────────────────
    // Security Groups
    // ──────────────────────────────────────────────

    /**
     * List all security groups in the zone.
     *
     * @param  int|null  $page  Page number (1-based).
     * @param  int|null  $perPage  Number of items per page.
     * @return array<string, mixed>
     */
    public function listSecurityGroups(?int $page = null, ?int $perPage = null): array
    {
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }

        return $this->request('GET', '/security_groups', $params);
    }

    // ──────────────────────────────────────────────
    // IPs
    // ──────────────────────────────────────────────

    /**
     * List all flexible IPs in the zone.
     *
     * @param  int|null  $page  Page number (1-based).
     * @param  int|null  $perPage  Number of items per page.
     * @return array<string, mixed>
     */
    public function listIps(?int $page = null, ?int $perPage = null): array
    {
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }

        return $this->request('GET', '/ips', $params);
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
     * @param  string|null  $overrideBaseUrl  Override the base URL for this request.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], ?string $overrideBaseUrl = null): array
    {
        $response = $this->rawRequest($method, $path, $data, $overrideBaseUrl);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Scaleway API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request data.
     * @param  string|null  $overrideBaseUrl  Override the base URL for this request.
     */
    private function rawRequest(string $method, string $path, array $data = [], ?string $overrideBaseUrl = null): Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Scaleway access token is not configured.');
        }

        $baseUrl = $overrideBaseUrl ?? $this->baseUrl;
        $url = $baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'X-Auth-Token' => $this->accessToken,
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
                    Log::warning("Scaleway API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Scaleway API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('message') ?? $response->body();
                Log::error("Scaleway API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Scaleway API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Scaleway API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Scaleway API: {$e->getMessage()}");
        }
    }
}
