<?php

namespace OpenCompany\Integrations\PlanetScale;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PlanetScaleService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.planetscale.com/api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List databases for an organization.
     *
     * @param  string  $organization  The organization name.
     * @param  int  $page   Page number (1-based).
     * @param  int  $limit  Results per page.
     * @return array<string, mixed>
     */
    public function listDatabases(string $organization, int $page = 1, int $limit = 20): array
    {
        return $this->request('GET', "/organizations/{$organization}/databases", [
            'page' => $page,
            'per_page' => $limit,
        ]);
    }

    /**
     * Get a single database by name.
     *
     * @param  string  $organization  The organization name.
     * @param  string  $database  The database name.
     * @return array<string, mixed>
     */
    public function getDatabase(string $organization, string $database): array
    {
        return $this->request('GET', "/organizations/{$organization}/databases/" . urlencode($database));
    }

    /**
     * Create a new database in an organization.
     *
     * @param  string  $organization  The organization name.
     * @param  string  $name  The database name.
     * @param  array<string, mixed>  $options  Additional options (e.g., region, notes).
     * @return array<string, mixed>
     */
    public function createDatabase(string $organization, string $name, array $options = []): array
    {
        $body = array_merge(['name' => $name], $options);

        return $this->request('POST', "/organizations/{$organization}/databases", $body);
    }

    /**
     * List branches for a database.
     *
     * @param  string  $organization  The organization name.
     * @param  string  $database  The database name.
     * @param  int  $page   Page number (1-based).
     * @param  int  $limit  Results per page.
     * @return array<string, mixed>
     */
    public function listBranches(string $organization, string $database, int $page = 1, int $limit = 20): array
    {
        return $this->request('GET', "/organizations/{$organization}/databases/{$database}/branches", [
            'page' => $page,
            'per_page' => $limit,
        ]);
    }

    /**
     * Get a single branch of a database.
     *
     * @param  string  $organization  The organization name.
     * @param  string  $database  The database name.
     * @param  string  $branch  The branch name.
     * @return array<string, mixed>
     */
    public function getBranch(string $organization, string $database, string $branch): array
    {
        return $this->request('GET', "/organizations/{$organization}/databases/{$database}/branches/" . urlencode($branch));
    }

    /**
     * List organizations the authenticated user belongs to.
     *
     * @return array<string, mixed>
     */
    public function listOrganizations(): array
    {
        return $this->request('GET', '/organizations');
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path (e.g. /organizations).
     * @param  array<string, mixed>  $data  Query params (GET) or body (POST/PUT).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the PlanetScale API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('PlanetScale access token is not configured.');
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
                    Log::warning("PlanetScale API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("PlanetScale API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("PlanetScale API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("PlanetScale API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("PlanetScale API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to PlanetScale API: {$e->getMessage()}");
        }
    }
}
