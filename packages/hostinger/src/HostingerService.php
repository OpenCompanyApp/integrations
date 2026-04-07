<?php

namespace OpenCompany\Integrations\Hostinger;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HostingerService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://developers.hostinger.com/api',
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
        return $this->request('GET', '/users/current');
    }

    // ──────────────────────────────────────────────
    // Servers (VPS)
    // ──────────────────────────────────────────────

    /**
     * List all VPS servers in the account.
     *
     * @return array<string, mixed>
     */
    public function listServers(): array
    {
        return $this->request('GET', '/servers');
    }

    /**
     * Get details for a single VPS server.
     *
     * @return array<string, mixed>
     */
    public function getServer(int $serverId): array
    {
        return $this->request('GET', '/servers/' . $serverId);
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
    public function getDomain(int $domainId): array
    {
        return $this->request('GET', '/domains/' . $domainId);
    }

    // ──────────────────────────────────────────────
    // DNS
    // ──────────────────────────────────────────────

    /**
     * List DNS records for a domain.
     *
     * @return array<string, mixed>
     */
    public function listDnsRecords(int $domainId): array
    {
        return $this->request('GET', '/dns/' . $domainId . '/records');
    }

    // ──────────────────────────────────────────────
    // SSL
    // ──────────────────────────────────────────────

    /**
     * List SSL certificates in the account.
     *
     * @return array<string, mixed>
     */
    public function listSsl(): array
    {
        return $this->request('GET', '/ssl');
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
     * Make a raw HTTP request to the Hostinger API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request data.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Hostinger access token is not configured.');
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
                    Log::warning("Hostinger API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Hostinger API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('message') ?? $response->body();
                Log::error("Hostinger API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Hostinger API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Hostinger API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Hostinger API: {$e->getMessage()}");
        }
    }
}
