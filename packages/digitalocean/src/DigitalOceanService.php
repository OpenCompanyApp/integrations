<?php

namespace OpenCompany\Integrations\DigitalOcean;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DigitalOceanService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.digitalocean.com/v2',
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
    // Droplets
    // ──────────────────────────────────────────────

    /**
     * List all droplets in the account.
     *
     * @param  int|null  $page  Page number (1-based).
     * @param  int|null  $perPage  Number of items per page (max 200).
     * @return array<string, mixed>
     */
    public function listDroplets(?int $page = null, ?int $perPage = null): array
    {
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }

        return $this->request('GET', '/droplets', $params);
    }

    /**
     * Get details for a single droplet.
     *
     * @return array<string, mixed>
     */
    public function getDroplet(int $id): array
    {
        return $this->request('GET', '/droplets/' . $id);
    }

    /**
     * Create a new droplet.
     *
     * @param  array<string, mixed>  $params  Creation parameters (name, region, size, image, etc.).
     * @return array<string, mixed>
     */
    public function createDroplet(array $params): array
    {
        return $this->request('POST', '/droplets', $params);
    }

    /**
     * Delete a droplet by ID.
     */
    public function deleteDroplet(int $id): void
    {
        $this->request('DELETE', '/droplets/' . $id);
    }

    /**
     * Reboot a droplet.
     *
     * @return array<string, mixed>
     */
    public function rebootDroplet(int $id): array
    {
        return $this->request('POST', '/droplets/' . $id . '/actions', [
            'type' => 'reboot',
        ]);
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
        return $this->request('GET', '/domains');
    }

    /**
     * Get details for a single domain.
     *
     * @return array<string, mixed>
     */
    public function getDomain(string $name): array
    {
        return $this->request('GET', '/domains/' . urlencode($name));
    }

    // ──────────────────────────────────────────────
    // Spaces
    // ──────────────────────────────────────────────

    /**
     * List Spaces (object storage) in the account.
     *
     * @return array<string, mixed>
     */
    public function listSpaces(): array
    {
        return $this->request('GET', '/spaces');
    }

    // ──────────────────────────────────────────────
    // Kubernetes
    // ──────────────────────────────────────────────

    /**
     * List Kubernetes clusters.
     *
     * @return array<string, mixed>
     */
    public function listKubernetesClusters(): array
    {
        return $this->request('GET', '/kubernetes/clusters');
    }

    // ──────────────────────────────────────────────
    // HTTP helpers
    // ──────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g. "/droplets").
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
     * Make a raw HTTP request to the DigitalOcean API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request data.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('DigitalOcean access token is not configured.');
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
                    Log::warning("DigitalOcean API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("DigitalOcean API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('message') ?? $response->body();
                Log::error("DigitalOcean API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("DigitalOcean API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("DigitalOcean API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to DigitalOcean API: {$e->getMessage()}");
        }
    }
}
