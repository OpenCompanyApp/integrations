<?php

namespace OpenCompany\Integrations\Contabo;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ContaboService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.contabo.com/v1',
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
    // Compute Instances
    // ──────────────────────────────────────────────

    /**
     * List all compute instances (VPS).
     *
     * @param  int|null  $page  Page number (1-based).
     * @param  int|null  $perPage  Number of items per page.
     * @return array<string, mixed>
     */
    public function listInstances(?int $page = null, ?int $perPage = null): array
    {
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['size'] = $perPage;
        }

        return $this->request('GET', '/compute/v1/instances', $params);
    }

    /**
     * Get details for a single compute instance.
     *
     * @return array<string, mixed>
     */
    public function getInstance(int $id): array
    {
        return $this->request('GET', '/compute/v1/instances/' . $id);
    }

    // ──────────────────────────────────────────────
    // Snapshots
    // ──────────────────────────────────────────────

    /**
     * List all snapshots.
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
            $params['size'] = $perPage;
        }

        return $this->request('GET', '/compute/v1/snapshots', $params);
    }

    // ──────────────────────────────────────────────
    // Images
    // ──────────────────────────────────────────────

    /**
     * List all custom images.
     *
     * @param  int|null  $page  Page number (1-based).
     * @param  int|null  $perPage  Number of items per page.
     * @return array<string, mixed>
     */
    public function listImages(?int $page = null, ?int $perPage = null): array
    {
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['size'] = $perPage;
        }

        return $this->request('GET', '/compute/v1/images', $params);
    }

    // ──────────────────────────────────────────────
    // Networks
    // ──────────────────────────────────────────────

    /**
     * List all private networks.
     *
     * @param  int|null  $page  Page number (1-based).
     * @param  int|null  $perPage  Number of items per page.
     * @return array<string, mixed>
     */
    public function listNetworks(?int $page = null, ?int $perPage = null): array
    {
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['size'] = $perPage;
        }

        return $this->request('GET', '/networks/v1/networks', $params);
    }

    // ──────────────────────────────────────────────
    // SSH Keys
    // ──────────────────────────────────────────────

    /**
     * List all registered SSH keys.
     *
     * @return array<string, mixed>
     */
    public function listSshKeys(): array
    {
        return $this->request('GET', '/ssh-keys/v1/sshkeys');
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
        return $this->request('GET', '/users/v1/users/current');
    }

    // ──────────────────────────────────────────────
    // HTTP helpers
    // ──────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g. "/compute/v1/instances").
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
     * Make a raw HTTP request to the Contabo API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request data.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Contabo access token is not configured.');
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
                    Log::warning("Contabo API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Contabo API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('message') ?? $response->body();
                Log::error("Contabo API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Contabo API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Contabo API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Contabo API: {$e->getMessage()}");
        }
    }
}
