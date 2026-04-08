<?php

namespace OpenCompany\Integrations\Vultr;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VultrService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.vultr.com/v2',
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
    // Instances
    // ──────────────────────────────────────────────

    /**
     * List all instances in the account.
     *
     * @return array<string, mixed>
     */
    public function listInstances(): array
    {
        return $this->request('GET', '/instances');
    }

    /**
     * Get details for a single instance.
     *
     * @return array<string, mixed>
     */
    public function getInstance(string $id): array
    {
        return $this->request('GET', '/instances/' . $id);
    }

    // ──────────────────────────────────────────────
    // Plans
    // ──────────────────────────────────────────────

    /**
     * List all available plans.
     *
     * @return array<string, mixed>
     */
    public function listPlans(): array
    {
        return $this->request('GET', '/plans');
    }

    // ──────────────────────────────────────────────
    // Regions
    // ──────────────────────────────────────────────

    /**
     * List all available regions.
     *
     * @return array<string, mixed>
     */
    public function listRegions(): array
    {
        return $this->request('GET', '/regions');
    }

    // ──────────────────────────────────────────────
    // Snapshots
    // ──────────────────────────────────────────────

    /**
     * List all snapshots in the account.
     *
     * @return array<string, mixed>
     */
    public function listSnapshots(): array
    {
        return $this->request('GET', '/snapshots');
    }

    // ──────────────────────────────────────────────
    // SSH Keys
    // ──────────────────────────────────────────────

    /**
     * List all SSH keys in the account.
     *
     * @return array<string, mixed>
     */
    public function listSshKeys(): array
    {
        return $this->request('GET', '/ssh-keys');
    }

    // ──────────────────────────────────────────────
    // HTTP helpers
    // ──────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g. "/instances").
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
     * Make a raw HTTP request to the Vultr API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request data.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Vultr access token is not configured.');
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
                    Log::warning("Vultr API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Vultr API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('message') ?? $response->body();
                Log::error("Vultr API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Vultr API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Vultr API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Vultr API: {$e->getMessage()}");
        }
    }
}
