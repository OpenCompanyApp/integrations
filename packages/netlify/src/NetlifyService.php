<?php

namespace OpenCompany\Integrations\Netlify;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NetlifyService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.netlify.com/api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all sites.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., name, page, per_page).
     * @return array<string, mixed>
     */
    public function listSites(array $params = []): array
    {
        return $this->request('GET', '/sites', $params);
    }

    /**
     * Get details for a specific site.
     *
     * @param  string  $siteId  The site identifier.
     * @return array<string, mixed>
     */
    public function getSite(string $siteId): array
    {
        return $this->request('GET', '/sites/' . urlencode($siteId));
    }

    /**
     * List deploys for a site.
     *
     * @param  string  $siteId  The site identifier.
     * @param  array<string, mixed>  $params  Query parameters (e.g., page, per_page).
     * @return array<string, mixed>
     */
    public function listDeploys(string $siteId, array $params = []): array
    {
        return $this->request('GET', '/sites/' . urlencode($siteId) . '/deploys', $params);
    }

    /**
     * Get details for a specific deploy.
     *
     * @param  string  $deployId  The deploy identifier.
     * @return array<string, mixed>
     */
    public function getDeploy(string $deployId): array
    {
        return $this->request('GET', '/deploys/' . urlencode($deployId));
    }

    /**
     * List forms for a site.
     *
     * @param  string  $siteId  The site identifier.
     * @return array<string, mixed>
     */
    public function listForms(string $siteId): array
    {
        return $this->request('GET', '/sites/' . urlencode($siteId) . '/forms');
    }

    /**
     * List DNS zones.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listDnsZones(array $params = []): array
    {
        return $this->request('GET', '/dns_zones', $params);
    }

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data (query params for GET, body for POST/PUT).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        $json = $response->json();

        if (!is_array($json)) {
            return [];
        }

        return $json;
    }

    /**
     * Make a raw HTTP request to the Netlify API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Netlify access token is not configured.');
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

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Netlify API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Netlify API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $json = $response->json();
                $message = $json['message'] ?? $json['error'] ?? $body;

                Log::error("Netlify API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $message,
                ]);
                throw new \RuntimeException("Netlify API error ({$response->status()}): {$message}");
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Netlify API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Netlify API: {$e->getMessage()}");
        }
    }
}
