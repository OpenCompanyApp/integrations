<?php

namespace OpenCompany\Integrations\Heroku;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HerokuService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.heroku.com',
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
    // Apps
    // ──────────────────────────────────────────────

    /**
     * List all apps the user has access to.
     *
     * @return array<string, mixed>
     */
    public function listApps(): array
    {
        return $this->request('GET', '/apps');
    }

    /**
     * Get details for a single app.
     *
     * @return array<string, mixed>
     */
    public function getApp(string $appId): array
    {
        return $this->request('GET', '/apps/' . $appId);
    }

    // ──────────────────────────────────────────────
    // Dynos
    // ──────────────────────────────────────────────

    /**
     * List all dynos for a given app.
     *
     * @return array<string, mixed>
     */
    public function listDynos(string $appId): array
    {
        return $this->request('GET', '/apps/' . $appId . '/dynos');
    }

    // ──────────────────────────────────────────────
    // Add-ons
    // ──────────────────────────────────────────────

    /**
     * List all add-ons for a given app.
     *
     * @return array<string, mixed>
     */
    public function listAddons(string $appId): array
    {
        return $this->request('GET', '/apps/' . $appId . '/addons');
    }

    // ──────────────────────────────────────────────
    // Domains
    // ──────────────────────────────────────────────

    /**
     * List all domains for a given app.
     *
     * @return array<string, mixed>
     */
    public function listDomains(string $appId): array
    {
        return $this->request('GET', '/apps/' . $appId . '/domains');
    }

    // ──────────────────────────────────────────────
    // Collaborators
    // ──────────────────────────────────────────────

    /**
     * List all collaborators for a given app.
     *
     * @return array<string, mixed>
     */
    public function listCollaborators(string $appId): array
    {
        return $this->request('GET', '/apps/' . $appId . '/collaborators');
    }

    // ──────────────────────────────────────────────
    // HTTP helpers
    // ──────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g. "/apps").
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
     * Make a raw HTTP request to the Heroku API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request data.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Heroku API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/vnd.heroku+json; version=3',
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
                    Log::warning("Heroku API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Heroku API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('message') ?? $response->body();
                Log::error("Heroku API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Heroku API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Heroku API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Heroku API: {$e->getMessage()}");
        }
    }
}
