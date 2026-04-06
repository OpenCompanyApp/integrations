<?php

namespace OpenCompany\Integrations\Vercel;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VercelService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.vercel.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v2/user');
    }

    /**
     * List deployments.
     *
     * @param  array<string, mixed>  $params  Query parameters (project_id, state, limit, etc.)
     * @return array<string, mixed>
     */
    public function listDeployments(array $params = []): array
    {
        return $this->request('GET', '/v13/deployments', $params);
    }

    /**
     * Get a deployment by ID.
     *
     * @return array<string, mixed>
     */
    public function getDeployment(string $id): array
    {
        return $this->request('GET', '/v13/deployments/' . urlencode($id));
    }

    /**
     * Create a new deployment.
     *
     * @param  array<string, mixed>  $body  Deployment payload
     * @return array<string, mixed>
     */
    public function createDeployment(array $body): array
    {
        return $this->request('POST', '/v13/deployments', $body);
    }

    /**
     * List projects.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, from, etc.)
     * @return array<string, mixed>
     */
    public function listProjects(array $params = []): array
    {
        return $this->request('GET', '/v9/projects', $params);
    }

    /**
     * Get a project by ID.
     *
     * @return array<string, mixed>
     */
    public function getProject(string $id): array
    {
        return $this->request('GET', '/v9/projects/' . urlencode($id));
    }

    /**
     * List domains for a project.
     *
     * @return array<string, mixed>
     */
    public function listDomains(string $projectId): array
    {
        return $this->request('GET', '/v9/projects/' . urlencode($projectId) . '/domains');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Vercel API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Vercel access token is not configured.');
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
                    Log::warning("Vercel API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Vercel API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is unavailable.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Vercel API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Vercel API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
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
