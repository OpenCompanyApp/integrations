<?php

namespace OpenCompany\Integrations\LambdaLabs;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LambdaLabsService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://cloud.lambdalabs.com/api/v1',
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

    /**
     * Launch a new instance.
     *
     * @param  array<string, mixed>  $params  Launch parameters (name, region, instance_type, ssh_key_ids, etc.).
     * @return array<string, mixed>
     */
    public function launchInstance(array $params): array
    {
        return $this->request('POST', '/instance-operations/launch', $params);
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
    // Instance Types
    // ──────────────────────────────────────────────

    /**
     * List available instance types (GPU configurations).
     *
     * @return array<string, mixed>
     */
    public function listInstanceTypes(): array
    {
        return $this->request('GET', '/instance-types');
    }

    // ──────────────────────────────────────────────
    // Images
    // ──────────────────────────────────────────────

    /**
     * List available images (operating system templates).
     *
     * @return array<string, mixed>
     */
    public function listImages(): array
    {
        return $this->request('GET', '/images');
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
     * Make a raw HTTP request to the Lambda Labs API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request data.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Lambda Labs API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
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
                    Log::warning("Lambda Labs API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Lambda Labs API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $response->body();
                Log::error("Lambda Labs API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Lambda Labs API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Lambda Labs API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Lambda Labs API: {$e->getMessage()}");
        }
    }
}
