<?php

namespace OpenCompany\Integrations\Linode;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LinodeService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.linode.com/v4',
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
        return $this->request('GET', '/profile');
    }

    // ──────────────────────────────────────────────
    // Linode Instances
    // ──────────────────────────────────────────────

    /**
     * List all Linode instances in the account.
     *
     * @param  int|null  $page  Page number (1-based).
     * @param  int|null  $perPage  Number of items per page (max 500).
     * @return array<string, mixed>
     */
    public function listInstances(?int $page = null, ?int $perPage = null): array
    {
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }

        return $this->request('GET', '/linode/instances', $params);
    }

    /**
     * Get details for a single Linode instance.
     *
     * @return array<string, mixed>
     */
    public function getInstance(int $id): array
    {
        return $this->request('GET', '/linode/instances/' . $id);
    }

    // ──────────────────────────────────────────────
    // Volumes
    // ──────────────────────────────────────────────

    /**
     * List all block storage volumes in the account.
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
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }

        return $this->request('GET', '/domains', $params);
    }

    /**
     * Get details for a single domain.
     *
     * @return array<string, mixed>
     */
    public function getDomain(int $id): array
    {
        return $this->request('GET', '/domains/' . $id);
    }

    // ──────────────────────────────────────────────
    // StackScripts
    // ──────────────────────────────────────────────

    /**
     * List all StackScripts.
     *
     * @param  int|null  $page  Page number (1-based).
     * @param  int|null  $perPage  Number of items per page.
     * @return array<string, mixed>
     */
    public function listStackScripts(?int $page = null, ?int $perPage = null): array
    {
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }

        return $this->request('GET', '/linode/stackscripts', $params);
    }

    // ──────────────────────────────────────────────
    // HTTP helpers
    // ──────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g. "/linode/instances").
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
     * Make a raw HTTP request to the Linode API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request data.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Linode access token is not configured.');
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
                    Log::warning("Linode API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Linode API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('message') ?? $response->body();
                Log::error("Linode API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Linode API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Linode API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Linode API: {$e->getMessage()}");
        }
    }
}
