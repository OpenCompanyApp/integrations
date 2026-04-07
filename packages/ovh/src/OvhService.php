<?php

namespace OpenCompany\Integrations\Ovh;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OvhService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://eu.api.ovh.com/1.0',
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
        return $this->request('GET', '/me');
    }

    // ──────────────────────────────────────────────
    // Dedicated Servers
    // ──────────────────────────────────────────────

    /**
     * List all dedicated servers in the account.
     *
     * @return array<string, mixed>
     */
    public function listServers(): array
    {
        return $this->request('GET', '/dedicated/server');
    }

    /**
     * Get details for a single dedicated server.
     *
     * @return array<string, mixed>
     */
    public function getServer(string $serviceName): array
    {
        return $this->request('GET', '/dedicated/server/' . urlencode($serviceName));
    }

    // ──────────────────────────────────────────────
    // Domains
    // ──────────────────────────────────────────────

    /**
     * List all domains in the account.
     *
     * @return array<string, mixed>
     */
    public function listDomains(): array
    {
        return $this->request('GET', '/domain');
    }

    // ──────────────────────────────────────────────
    // VPS
    // ──────────────────────────────────────────────

    /**
     * List all VPS instances in the account.
     *
     * @return array<string, mixed>
     */
    public function listVps(): array
    {
        return $this->request('GET', '/vps');
    }

    // ──────────────────────────────────────────────
    // IP
    // ──────────────────────────────────────────────

    /**
     * List all IP addresses in the account.
     *
     * @return array<string, mixed>
     */
    public function listIp(): array
    {
        return $this->request('GET', '/ip');
    }

    // ──────────────────────────────────────────────
    // Public Cloud Projects
    // ──────────────────────────────────────────────

    /**
     * List all public cloud projects.
     *
     * @return array<string, mixed>
     */
    public function listProjects(): array
    {
        return $this->request('GET', '/cloud/project');
    }

    // ──────────────────────────────────────────────
    // HTTP helpers
    // ──────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g. "/dedicated/server").
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
     * Make a raw HTTP request to the OVH API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request data.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('OVH access token is not configured.');
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
                    Log::warning("OVH API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("OVH API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('message') ?? $response->body();
                Log::error("OVH API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("OVH API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("OVH API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to OVH API: {$e->getMessage()}");
        }
    }
}
