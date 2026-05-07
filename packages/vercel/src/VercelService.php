<?php

namespace OpenCompany\Integrations\Vercel;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Vercel REST API.
 *
 * Handles bearer-token authentication, versioned endpoint dispatch, error
 * normalization, and parsed JSON responses for projects, deployments, domains,
 * teams, and the authenticated user.
 */
class VercelService
{
    /**
     * @param  string  $token  Vercel access token.
     * @param  string  $baseUrl  Vercel API origin, usually https://api.vercel.com.
     */
    public function __construct(
        private string $token = '',
        private string $baseUrl = 'https://api.vercel.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return ! empty($this->token);
    }

    /* ------------------------------------------------------------------
     *  Projects
     * ------------------------------------------------------------------ */

    public function listProjects(array $params = []): array
    {
        return $this->request('GET', '/v10/projects', $params);
    }

    /**
     * Get a project by ID or name.
     *
     * @return array<string, mixed>
     */
    public function getProject(string $id, array $params = []): array
    {
        return $this->request('GET', '/v9/projects/' . urlencode($id), $params);
    }

    /* ------------------------------------------------------------------
     *  Deployments
     * ------------------------------------------------------------------ */

    public function listDeployments(array $params = []): array
    {
        return $this->request('GET', '/v6/deployments', $params);
    }

    /**
     * Get a deployment by ID or URL.
     *
     * @return array<string, mixed>
     */
    public function getDeployment(string $id, array $params = []): array
    {
        return $this->request('GET', '/v13/deployments/' . urlencode($id), $params);
    }

    /**
     * Create a deployment.
     *
     * @param  array<string, mixed>  $body  Vercel create-deployment request body.
     * @param  array<string, mixed>  $params  Query parameters such as teamId or slug.
     * @return array<string, mixed>
     */
    public function createDeployment(array $body, array $params = []): array
    {
        return $this->request('POST', '/v13/deployments', $body, $params);
    }

    /* ------------------------------------------------------------------
     *  Domains
     * ------------------------------------------------------------------ */

    public function listDomains(array $params = []): array
    {
        return $this->request('GET', '/v5/domains', $params);
    }

    /* ------------------------------------------------------------------
     *  Teams
     * ------------------------------------------------------------------ */

    public function listTeams(array $params = []): array
    {
        return $this->request('GET', '/v2/teams', $params);
    }

    /* ------------------------------------------------------------------
     *  User
     * ------------------------------------------------------------------ */

    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v2/user');
    }

    /* ------------------------------------------------------------------
     *  HTTP helper
     * ------------------------------------------------------------------ */

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Versioned API path.
     * @param  array<string, mixed>  $data  Query params for GET or JSON body for writes.
     * @param  array<string, mixed>  $query  Additional query params for writes.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], array $query = []): array
    {
        $response = $this->rawRequest($method, $path, $data, $query);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Vercel REST API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Versioned API path.
     * @param  array<string, mixed>  $data  Query params for GET or JSON body for writes.
     * @param  array<string, mixed>  $query  Additional query params for writes.
     */
    private function rawRequest(string $method, string $path, array $data = [], array $query = []): Response
    {
        if ($this->token === '') {
            throw new \RuntimeException('Vercel API token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => "Bearer {$this->token}",
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            if (strtoupper($method) !== 'GET' && $query !== []) {
                $url .= '?' . http_build_query($query);
            }

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $message = $response->json('error.message') ?? $response->json('message') ?? $response->body();
                Log::error("Vercel API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $message,
                ]);
                throw new \RuntimeException("Vercel API error ({$response->status()}): " . (is_string($message) ? $message : json_encode($message)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Vercel API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Vercel API: {$e->getMessage()}");
        }
    }
}
