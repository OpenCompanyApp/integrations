<?php

namespace OpenCompany\Integrations\Paperspace;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaperspaceService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.paperspace.com/v1',
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
    // User
    // ──────────────────────────────────────────────

    /**
     * Get information about the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    // ──────────────────────────────────────────────
    // Machines
    // ──────────────────────────────────────────────

    /**
     * List all machines in the account.
     *
     * @return array<string, mixed>
     */
    public function listMachines(): array
    {
        return $this->request('GET', '/machines');
    }

    /**
     * Get details for a single machine.
     *
     * @return array<string, mixed>
     */
    public function getMachine(string $machineId): array
    {
        return $this->request('GET', '/machines/' . urlencode($machineId));
    }

    // ──────────────────────────────────────────────
    // Notebooks
    // ──────────────────────────────────────────────

    /**
     * List all notebooks in the account.
     *
     * @return array<string, mixed>
     */
    public function listNotebooks(): array
    {
        return $this->request('GET', '/notebooks');
    }

    // ──────────────────────────────────────────────
    // Datasets
    // ──────────────────────────────────────────────

    /**
     * List all datasets in the account.
     *
     * @return array<string, mixed>
     */
    public function listDatasets(): array
    {
        return $this->request('GET', '/datasets');
    }

    // ──────────────────────────────────────────────
    // Projects
    // ──────────────────────────────────────────────

    /**
     * List all projects in the account.
     *
     * @return array<string, mixed>
     */
    public function listProjects(): array
    {
        return $this->request('GET', '/projects');
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
        return $this->request('GET', '/sshKeys');
    }

    // ──────────────────────────────────────────────
    // HTTP helpers
    // ──────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g. "/machines").
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
     * Make a raw HTTP request to the Paperspace API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request data.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Paperspace API token is not configured.');
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
                    Log::warning("Paperspace API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Paperspace API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('message') ?? $response->body();
                Log::error("Paperspace API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Paperspace API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Paperspace API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Paperspace API: {$e->getMessage()}");
        }
    }
}
