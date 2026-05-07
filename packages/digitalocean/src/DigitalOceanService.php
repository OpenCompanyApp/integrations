<?php

namespace OpenCompany\Integrations\DigitalOcean;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the DigitalOcean API v2.
 *
 * Handles bearer-token authentication, request dispatch, error normalization,
 * and parsed JSON responses for DigitalOcean cloud resources.
 */
class DigitalOceanService
{
    /**
     * @param  string  $accessToken  DigitalOcean personal access token or OAuth bearer token.
     * @param  string  $baseUrl  DigitalOcean API v2 base URL.
     */
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
     * @param  int|null  $page  Page number (1-based).
     * @param  int|null  $perPage  Number of items per page.
     * @return array<string, mixed>
     */
    public function listDomains(?int $page = null, ?int $perPage = null): array
    {
        return $this->request('GET', '/domains', $this->paginationParams($page, $perPage));
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
     * List Spaces access keys available to the account.
     *
     * DigitalOcean's bearer-token API exposes Spaces key management at
     * /v2/spaces/keys. Bucket/object operations use the separate S3-compatible
     * Spaces API and are intentionally not called from this OAuth-token client.
     *
     * @param  array<string, mixed>  $params  Query parameters (page, per_page, sort, sort_direction, name, bucket, permission).
     * @return array<string, mixed>
     */
    public function listSpaces(array $params = []): array
    {
        return $this->request('GET', '/spaces/keys', array_filter($params, static fn ($value): bool => $value !== null && $value !== ''));
    }

    // ──────────────────────────────────────────────
    // Kubernetes
    // ──────────────────────────────────────────────

    /**
     * List Kubernetes clusters.
     *
     * @param  int|null  $page  Page number (1-based).
     * @param  int|null  $perPage  Number of items per page.
     * @return array<string, mixed>
     */
    public function listKubernetesClusters(?int $page = null, ?int $perPage = null): array
    {
        return $this->request('GET', '/kubernetes/clusters', $this->paginationParams($page, $perPage));
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

    /**
     * Build DigitalOcean pagination query parameters.
     *
     * @return array<string, int>
     */
    private function paginationParams(?int $page, ?int $perPage): array
    {
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }

        return $params;
    }
}
