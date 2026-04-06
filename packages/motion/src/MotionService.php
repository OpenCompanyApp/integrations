<?php

namespace OpenCompany\Integrations\Motion;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MotionService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.usemotion.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List tasks with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters (status, projectId, assigneeId, limit, cursor).
     * @return array<string, mixed>
     */
    public function listTasks(array $params = []): array
    {
        return $this->request('GET', '/v1/tasks', $params);
    }

    /**
     * Get a single task by ID.
     *
     * @return array<string, mixed>
     */
    public function getTask(string $taskId): array
    {
        return $this->request('GET', '/v1/tasks/' . urlencode($taskId));
    }

    /**
     * Create a new task.
     *
     * @param  array<string, mixed>  $data  Task fields (name, projectId, assigneeId, dueDate, priority, description).
     * @return array<string, mixed>
     */
    public function createTask(array $data): array
    {
        return $this->request('POST', '/v1/tasks', $data);
    }

    /**
     * List all projects.
     *
     * @return array<string, mixed>
     */
    public function listProjects(): array
    {
        return $this->request('GET', '/v1/projects');
    }

    /**
     * Get a single project by ID.
     *
     * @return array<string, mixed>
     */
    public function getProject(string $projectId): array
    {
        return $this->request('GET', '/v1/projects/' . urlencode($projectId));
    }

    /**
     * List schedules within a date range.
     *
     * @param  array<string, mixed>  $params  Query parameters (startDate, endDate).
     * @return array<string, mixed>
     */
    public function listSchedules(array $params = []): array
    {
        return $this->request('GET', '/v1/schedules', $params);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Motion API.
     *
     * @param  array<string, mixed>  $data
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Motion access token is not configured.');
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
                    Log::warning("Motion API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Motion API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is unavailable.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("Motion API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Motion API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Motion API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Motion API: {$e->getMessage()}");
        }
    }
}
