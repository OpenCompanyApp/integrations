<?php

namespace OpenCompany\Integrations\Asana;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Asana REST API.
 *
 * Wraps HTTP calls to Asana's REST endpoints for tasks, projects,
 * sections, workspaces, teams, users, tags, and stories (comments).
 *
 * Authentication uses a Personal Access Token (or OAuth token) sent as
 * a Bearer header.  Responses are wrapped in a top-level `data` key.
 * Pagination is cursor-based via the `offset` parameter.
 */
class AsanaService
{
    private const BASE_URL = 'https://app.asana.com/api/1.0';

    /**
     * @param  string  $accessToken  Asana Personal Access Token or OAuth token
     */
    public function __construct(
        private string $accessToken = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Connection ──────────────────────────────────────────

    /**
     * Test the connection by fetching the current user profile.
     *
     * @return array<string, mixed>
     */
    public function testConnection(): array
    {
        return $this->request('GET', '/users/me');
    }

    // ── Tasks ───────────────────────────────────────────────

    /**
     * Create a new task.
     *
     * @param  array<string, mixed>  $data  Task fields (name, notes, projects, assignee, due_on, tags, workspace)
     * @return array<string, mixed>
     */
    public function createTask(array $data): array
    {
        return $this->request('POST', '/tasks', $data);
    }

    /**
     * Get a task by ID.
     *
     * @param  string  $id  Task GID
     * @return array<string, mixed>
     */
    public function getTask(string $id): array
    {
        return $this->request('GET', "/tasks/{$id}", [
            'opt_fields' => 'name,notes,assignee,due_on,completed,tags,projects,memberships,workspace',
        ]);
    }

    /**
     * Update a task.
     *
     * @param  string                 $id   Task GID
     * @param  array<string, mixed>   $data Fields to update
     * @return array<string, mixed>
     */
    public function updateTask(string $id, array $data): array
    {
        return $this->request('PUT', "/tasks/{$id}", $data);
    }

    /**
     * Delete a task.
     *
     * @param  string  $id  Task GID
     * @return array<string, mixed>
     */
    public function deleteTask(string $id): array
    {
        return $this->request('DELETE', "/tasks/{$id}");
    }

    /**
     * List tasks with optional filters.
     *
     * @param  array<string, mixed>  $params  Query params (project, assignee, workspace, completed_since, limit, offset)
     * @return array<string, mixed>
     */
    public function listTasks(array $params = []): array
    {
        if (! isset($params['opt_fields'])) {
            $params['opt_fields'] = 'name,notes,assignee,due_on,completed,tags,projects';
        }

        return $this->request('GET', '/tasks', $params);
    }

    /**
     * Create a subtask under a parent task.
     *
     * @param  string                 $parentId  Parent task GID
     * @param  array<string, mixed>   $data      Subtask fields (name, notes, assignee)
     * @return array<string, mixed>
     */
    public function createSubtask(string $parentId, array $data): array
    {
        return $this->request('POST', "/tasks/{$parentId}/subtasks", $data);
    }

    // ── Stories (Comments) ──────────────────────────────────

    /**
     * Add a comment (story) to a task.
     *
     * @param  string  $taskId  Task GID
     * @param  string  $text    Comment text
     * @return array<string, mixed>
     */
    public function addComment(string $taskId, string $text): array
    {
        return $this->request('POST', "/tasks/{$taskId}/stories", [
            'text' => $text,
        ]);
    }

    /**
     * List stories (comments) on a task.
     *
     * @param  string                 $taskId  Task GID
     * @param  array<string, mixed>   $params  Query params (limit, offset)
     * @return array<string, mixed>
     */
    public function listComments(string $taskId, array $params = []): array
    {
        return $this->request('GET', "/tasks/{$taskId}/stories", $params);
    }

    // ── Projects ────────────────────────────────────────────

    /**
     * Create a new project.
     *
     * @param  array<string, mixed>  $data  Project fields (name, notes, workspace, team, color)
     * @return array<string, mixed>
     */
    public function createProject(array $data): array
    {
        return $this->request('POST', '/projects', $data);
    }

    /**
     * Get a project by ID.
     *
     * @param  string  $id  Project GID
     * @return array<string, mixed>
     */
    public function getProject(string $id): array
    {
        return $this->request('GET', "/projects/{$id}", [
            'opt_fields' => 'name,notes,workspace,team,color,archived',
        ]);
    }

    /**
     * List projects with optional filters.
     *
     * @param  array<string, mixed>  $params  Query params (workspace, team, archived, limit, offset)
     * @return array<string, mixed>
     */
    public function listProjects(array $params = []): array
    {
        if (! isset($params['opt_fields'])) {
            $params['opt_fields'] = 'name,notes,workspace,team,color,archived';
        }

        return $this->request('GET', '/projects', $params);
    }

    /**
     * List sections in a project.
     *
     * @param  string                 $projectId  Project GID
     * @param  array<string, mixed>   $params     Query params (limit, offset)
     * @return array<string, mixed>
     */
    public function listSections(string $projectId, array $params = []): array
    {
        return $this->request('GET', "/projects/{$projectId}/sections", $params);
    }

    // ── Workspaces & Teams ──────────────────────────────────

    /**
     * List all workspaces the authenticated user has access to.
     *
     * @return array<string, mixed>
     */
    public function listWorkspaces(): array
    {
        return $this->request('GET', '/workspaces');
    }

    /**
     * List teams in a workspace.
     *
     * @param  string  $workspaceId  Workspace GID
     * @return array<string, mixed>
     */
    public function listTeams(string $workspaceId): array
    {
        return $this->request('GET', "/workspaces/{$workspaceId}/teams");
    }

    // ── Users ───────────────────────────────────────────────

    /**
     * List users with optional filters.
     *
     * @param  array<string, mixed>  $params  Query params (workspace, limit, offset)
     * @return array<string, mixed>
     */
    public function listUsers(array $params = []): array
    {
        return $this->request('GET', '/users', $params);
    }

    /**
     * Get a user by ID.
     *
     * @param  string  $id  User GID
     * @return array<string, mixed>
     */
    public function getUser(string $id): array
    {
        return $this->request('GET', "/users/{$id}");
    }

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Get the user task list for a given user and workspace.
     *
     * @param  string  $userId       User GID
     * @param  string  $workspaceId  Workspace GID
     * @return array<string, mixed>
     */
    public function getUserTaskList(string $userId, string $workspaceId): array
    {
        return $this->request('GET', "/users/{$userId}/user_task_list", [
            'workspace' => $workspaceId,
        ]);
    }

    // ── Tags ────────────────────────────────────────────────

    /**
     * List tags with optional filters.
     *
     * @param  array<string, mixed>  $params  Query params (workspace, limit, offset)
     * @return array<string, mixed>
     */
    public function listTags(array $params = []): array
    {
        return $this->request('GET', '/tags', $params);
    }

    /**
     * Create a new tag.
     *
     * @param  array<string, mixed>  $data  Tag fields (name, workspace, color)
     * @return array<string, mixed>
     */
    public function createTag(array $data): array
    {
        return $this->request('POST', '/tags', $data);
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to Asana.
     *
     * Sends the Bearer token in the Authorization header.  For POST/PUT
     * requests the payload is wrapped in a `data` key as required by
     * the Asana API.  For GET requests the params are sent as query
     * parameters.
     *
     * @param  string                 $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string                 $path    API path (e.g. /tasks)
     * @param  array<string, mixed>   $data    Query or body params
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Asana access token is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, ['data' => $data]),
                'PUT'    => $http->put($url, ['data' => $data]),
                'DELETE' => $http->delete($url),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                Log::error("Asana API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);

                throw new \RuntimeException("Asana API error ({$response->status()}): {$response->body()}");
            }

            return $response->json('data') ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Asana API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Asana API: {$e->getMessage()}");
        }
    }
}
