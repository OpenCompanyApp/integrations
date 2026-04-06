<?php

namespace OpenCompany\Integrations\Nifty;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NiftyService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.niftyco.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all projects.
     *
     * @return array<string, mixed>
     */
    public function listProjects(array $params = []): array
    {
        return $this->request('GET', '/projects', $params);
    }

    /**
     * Get a single project by ID.
     *
     * @return array<string, mixed>
     */
    public function getProject(string $projectId): array
    {
        return $this->request('GET', '/projects/' . urlencode($projectId));
    }

    /**
     * List tasks with optional filters.
     *
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
    public function getTask(string $taskId): array
    {
        return $this->request('GET', '/tasks/' . urlencode($taskId));
    }

    /**
     * Create a new task.
     *
     * @return array<string, mixed>
     */
    public function createTask(array $data): array
    {
        return $this->request('POST', '/tasks', $data);
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
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Nifty API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Nifty access token is not configured.');
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

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Nifty API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Nifty API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Nifty API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Nifty API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Nifty API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Nifty API: {$e->getMessage()}");
        }
    }
}
