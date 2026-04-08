<?php

namespace OpenCompany\Integrations\Teamwork;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Teamwork REST API v1.
 *
 * Wraps HTTP calls to Teamwork's REST endpoints for projects, tasks,
 * timers, and user management.
 *
 * Authentication uses a Bearer token sent in the Authorization header.
 */
class TeamworkService
{
    private const BASE_URL = 'https://api.teamwork.com/v1';

    /**
     * @param  string  $apiToken  Teamwork API token
     */
    public function __construct(
        private string $apiToken = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->apiToken);
    }

    // ── Connection ──────────────────────────────────────────

    /**
     * Test the connection by fetching the current user profile.
     *
     * @return array<string, mixed>
     */
    public function testConnection(): array
    {
        return $this->request('GET', '/me.json');
    }

    // ── Projects ────────────────────────────────────────────

    /**
     * List projects with optional filters.
     *
     * @param  array<string, mixed>  $params  Query params (status, includePeople, page, pageSize)
     * @return array<string, mixed>
     */
    public function listProjects(array $params = []): array
    {
        return $this->request('GET', '/projects.json', $params);
    }

    /**
     * Get a project by ID.
     *
     * @param  int  $id  Project ID
     * @return array<string, mixed>
     */
    public function getProject(int $id): array
    {
        return $this->request('GET', "/projects/{$id}.json");
    }

    // ── Tasks ───────────────────────────────────────────────

    /**
     * List tasks with optional filters.
     *
     * @param  array<string, mixed>  $params  Query params (projectId, include, page, pageSize, filter, sort)
     * @return array<string, mixed>
     */
    public function listTasks(array $params = []): array
    {
        $projectId = $params['projectId'] ?? null;
        unset($params['projectId']);

        if ($projectId) {
            return $this->request('GET', "/projects/{$projectId}/tasks.json", $params);
        }

        return $this->request('GET', '/tasks.json', $params);
    }

    /**
     * Get a task by ID.
     *
     * @param  int  $id  Task ID
     * @return array<string, mixed>
     */
    public function getTask(int $id): array
    {
        return $this->request('GET', "/tasks/{$id}.json");
    }

    /**
     * Create a new task.
     *
     * @param  array<string, mixed>  $data  Task fields (name, description, projectId, assigneeId, dueDate, priority, etc.)
     * @return array<string, mixed>
     */
    public function createTask(array $data): array
    {
        $projectId = $data['projectId'] ?? null;
        unset($data['projectId']);

        if ($projectId) {
            return $this->request('POST', "/projects/{$projectId}/tasks.json", ['todo-item' => $data]);
        }

        return $this->request('POST', '/tasks.json', ['todo-item' => $data]);
    }

    // ── Timers ──────────────────────────────────────────────

    /**
     * List timers for the authenticated user.
     *
     * @param  array<string, mixed>  $params  Query params (page, pageSize)
     * @return array<string, mixed>
     */
    public function listTimers(array $params = []): array
    {
        return $this->request('GET', '/timers.json', $params);
    }

    // ── Users ───────────────────────────────────────────────

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me.json');
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to Teamwork.
     *
     * Sends the Bearer token in the Authorization header.  For POST
     * requests the payload is sent as JSON.  For GET requests the
     * params are sent as query parameters.
     *
     * @param  string                 $method  HTTP method (GET, POST)
     * @param  string                 $path    API path (e.g. /projects.json)
     * @param  array<string, mixed>   $data    Query or body params
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Teamwork API token is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                Log::error("Teamwork API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);

                throw new \RuntimeException("Teamwork API error ({$response->status()}): {$response->body()}");
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Teamwork API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Teamwork API: {$e->getMessage()}");
        }
    }
}
