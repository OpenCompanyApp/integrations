<?php

namespace OpenCompany\Integrations\MeisterTask;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MeisterTaskService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://www.meistertask.com/api',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all projects the authenticated user has access to.
     *
     * @return array<string, mixed>
     */
    public function listProjects(): array
    {
        return $this->request('GET', '/projects');
    }

    /**
     * Get a single project by ID.
     *
     * @return array<string, mixed>
     */
    public function getProject(int $projectId): array
    {
        return $this->request('GET', '/projects/' . $projectId);
    }

    /**
     * Create a new task in a project.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createTask(int $projectId, array $data): array
    {
        return $this->request('POST', '/projects/' . $projectId . '/tasks', $data);
    }

    /**
     * List tasks. Optionally filter by project or status.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listTasks(array $params = []): array
    {
        return $this->request('GET', '/tasks', $params);
    }

    /**
     * Get a single task by ID.
     *
     * @return array<string, mixed>
     */
    public function getTask(int $taskId): array
    {
        return $this->request('GET', '/tasks/' . $taskId);
    }

    /**
     * Update an existing task.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function updateTask(int $taskId, array $data): array
    {
        return $this->request('PUT', '/tasks/' . $taskId, $data);
    }

    /**
     * Get the currently authenticated user's profile.
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
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the MeisterTask API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('MeisterTask access token is not configured.');
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
                    Log::warning("MeisterTask API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("MeisterTask API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("MeisterTask API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("MeisterTask API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("MeisterTask API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to MeisterTask API: {$e->getMessage()}");
        }
    }
}
