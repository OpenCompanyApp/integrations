<?php

namespace OpenCompany\Integrations\Teamwork;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Teamwork Projects API v3.
 *
 * Uses HTTP Basic Auth with the API key as the username and "X" as the password.
 * Base URL pattern: https://{hostname}/projects/api/v3
 */
class TeamworkService
{
    /**
     * Create a new TeamworkService instance.
     *
     * @param string $apiKey   Teamwork API key (used as Basic Auth username).
     * @param string $hostname Teamwork installation hostname (e.g., "myteam.teamwork.com").
     */
    public function __construct(
        private string $apiKey = '',
        private string $hostname = '',
    ) {
        $this->hostname = rtrim($this->hostname, '/');
    }

    /**
     * Check whether the service has enough configuration to make requests.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->hostname);
    }

    /**
     * Build the full base URL for API v3 requests.
     *
     * @return string e.g. "https://myteam.teamwork.com/projects/api/v3"
     */
    public function getBaseUrl(): string
    {
        $host = $this->hostname;

        if (!str_starts_with($host, 'http://') && !str_starts_with($host, 'https://')) {
            $host = 'https://' . $host;
        }

        return rtrim($host, '/') . '/projects/api/v3';
    }

    // ─── Projects ───────────────────────────────────────────────

    /**
     * List projects.
     *
     * @param array $params Query parameters (e.g. page, pageSize, search).
     * @return array parsed JSON response
     */
    public function listProjects(array $params = []): array
    {
        return $this->request('GET', '/projects', $params);
    }

    /**
     * Get a single project by ID.
     *
     * @param int $projectId
     * @return array
     */
    public function getProject(int $projectId): array
    {
        return $this->request('GET', "/projects/{$projectId}");
    }

    /**
     * Create a new project.
     *
     * @param string $name        Project name.
     * @param string $description Optional project description.
     * @param array  $extra       Additional project fields.
     * @return array
     */
    public function createProject(string $name, string $description = '', array $extra = []): array
    {
        return $this->request('POST', '/projects', array_merge([
            'name' => $name,
            'description' => $description,
        ], $extra));
    }

    // ─── Tasks ──────────────────────────────────────────────────

    /**
     * List tasks for a project.
     *
     * @param int   $projectId
     * @param array $params    Query parameters.
     * @return array
     */
    public function listTasks(int $projectId, array $params = []): array
    {
        return $this->request('GET', "/projects/{$projectId}/tasks", $params);
    }

    /**
     * Get a single task by ID.
     *
     * @param int $taskId
     * @return array
     */
    public function getTask(int $taskId): array
    {
        return $this->request('GET', "/tasks/{$taskId}");
    }

    /**
     * Create a task in a project.
     *
     * @param int    $projectId
     * @param string $name      Task name.
     * @param array  $extra     Additional task fields (description, assigneeIds, etc.).
     * @return array
     */
    public function createTask(int $projectId, string $name, array $extra = []): array
    {
        return $this->request('POST', "/projects/{$projectId}/tasks", array_merge([
            'name' => $name,
        ], $extra));
    }

    /**
     * Update a task.
     *
     * @param int   $taskId
     * @param array $data   Fields to update.
     * @return array
     */
    public function updateTask(int $taskId, array $data): array
    {
        return $this->request('PUT', "/tasks/{$taskId}", $data);
    }

    /**
     * Mark a task as complete.
     *
     * @param int $taskId
     * @return array
     */
    public function completeTask(int $taskId): array
    {
        return $this->request('PUT', "/tasks/{$taskId}/complete");
    }

    // ─── Teams ──────────────────────────────────────────────────

    /**
     * List teams.
     *
     * @param array $params Query parameters.
     * @return array
     */
    public function listTeams(array $params = []): array
    {
        return $this->request('GET', '/teams', $params);
    }

    /**
     * Get a single team by ID.
     *
     * @param int $teamId
     * @return array
     */
    public function getTeam(int $teamId): array
    {
        return $this->request('GET', "/teams/{$teamId}");
    }

    // ─── Time Entries ───────────────────────────────────────────

    /**
     * List time entries for a project.
     *
     * @param int   $projectId
     * @param array $params    Query parameters.
     * @return array
     */
    public function listTimeEntries(int $projectId, array $params = []): array
    {
        return $this->request('GET', "/projects/{$projectId}/time", $params);
    }

    /**
     * Create a time entry for a project.
     *
     * @param int   $projectId
     * @param array $data      Time entry fields (hours, minutes, date, description, etc.).
     * @return array
     */
    public function createTimeEntry(int $projectId, array $data): array
    {
        return $this->request('POST', "/projects/{$projectId}/time", $data);
    }

    // ─── User ───────────────────────────────────────────────────

    /**
     * Get the currently authenticated user.
     *
     * @return array
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    // ─── HTTP Layer ─────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE).
     * @param string $path   API path relative to base URL (e.g. "/projects").
     * @param array  $data   Query params (GET) or body data (POST/PUT).
     * @return array
     *
     * @throws \RuntimeException on connection or API errors.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Teamwork API.
     *
     * @param string $method HTTP method.
     * @param string $path   API path relative to base URL.
     * @param array  $data   Query params or body data.
     * @return Response
     *
     * @throws \RuntimeException on configuration, connection, or API errors.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->apiKey || !$this->hostname) {
            throw new \RuntimeException('Teamwork API key and hostname are not configured.');
        }

        $url = $this->getBaseUrl() . $path;

        try {
            $http = Http::withBasicAuth($this->apiKey, 'X')
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'   => $http->get($url, $data),
                'POST'  => $http->post($url, $data),
                'PUT'   => $http->put($url, $data),
                'DELETE'=> $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains((string) $contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Teamwork API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Teamwork API endpoint not available (HTTP {$response->status()}). Check the hostname and API path.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Teamwork API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $error,
                ]);
                throw new \RuntimeException("Teamwork API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Teamwork API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Teamwork API: {$e->getMessage()}");
        }
    }
}
