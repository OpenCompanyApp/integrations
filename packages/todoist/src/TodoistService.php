<?php

namespace OpenCompany\Integrations\Todoist;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * Todoist API client for interacting with tasks, projects, sections, labels, and comments.
 *
 * Communicates with the Todoist REST API v2 and Sync API v9.
 * Authentication uses a personal access token sent as a Bearer header.
 */
class TodoistService
{
    private const DEFAULT_BASE_URL = 'https://api.todoist.com';
    private const REST_V2_PREFIX = '/rest/v2';
    private const QUICK_ADD_URL = '/api/v1/quick/add';
    private const SYNC_V9_PREFIX = '/sync/v9';

    /**
     * @param string $accessToken Todoist personal access token for API authentication.
     * @param string $baseUrl     Base URL for the Todoist API (default: https://api.todoist.com).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = self::DEFAULT_BASE_URL,
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Todoist integration is properly configured with an access token.
     *
     * @return bool True if an access token is set.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    // ─── User ──────────────────────────────────────────────────────────────

    /**
     * Get the current user's profile via the Sync v9 API.
     *
     * Returns user information including full name, email, avatar, and plan details.
     *
     * @return array<string, mixed> User profile data.
     *
     * @throws RuntimeException If the request fails.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', self::SYNC_V9_PREFIX . '/user');
    }

    /**
     * Test the connection by fetching the current user's profile.
     *
     * @return array<string, mixed> User profile data including name and email.
     *
     * @throws RuntimeException If the request fails.
     */
    public function testConnection(): array
    {
        return $this->getCurrentUser();
    }

    // ─── Tasks ─────────────────────────────────────────────────────────────

    /**
     * Create a new task in Todoist.
     *
     * @param array<string, mixed> $params Task properties (content, project_id, section_id, labels, priority, due_date, due_string, description).
     * @return array<string, mixed> The created task object.
     *
     * @throws RuntimeException If the request fails.
     */
    public function createTask(array $params): array
    {
        return $this->request('POST', self::REST_V2_PREFIX . '/tasks', $params);
    }

    /**
     * Retrieve a single task by its ID.
     *
     * @param string $id The task ID.
     * @return array<string, mixed> The task object.
     *
     * @throws RuntimeException If the request fails.
     */
    public function getTask(string $id): array
    {
        return $this->request('GET', self::REST_V2_PREFIX . "/tasks/{$id}");
    }

    /**
     * Update an existing task.
     *
     * @param string $id The task ID.
     * @param array<string, mixed> $params Fields to update (content, description, labels, priority, due_date).
     * @return array<string, mixed> The updated task object.
     *
     * @throws RuntimeException If the request fails.
     */
    public function updateTask(string $id, array $params): array
    {
        return $this->request('POST', self::REST_V2_PREFIX . "/tasks/{$id}", $params);
    }

    /**
     * Delete a task permanently.
     *
     * @param string $id The task ID.
     * @return array<string, mixed> Confirmation of deletion.
     *
     * @throws RuntimeException If the request fails.
     */
    public function deleteTask(string $id): array
    {
        $this->request('DELETE', self::REST_V2_PREFIX . "/tasks/{$id}");

        return ['deleted' => true, 'id' => $id];
    }

    /**
     * Mark a task as completed (close it).
     *
     * @param string $id The task ID.
     * @return array<string, mixed> Confirmation of closure.
     *
     * @throws RuntimeException If the request fails.
     */
    public function closeTask(string $id): array
    {
        $this->request('POST', self::REST_V2_PREFIX . "/tasks/{$id}/close");

        return ['closed' => true, 'id' => $id];
    }

    /**
     * Reopen a previously completed task.
     *
     * @param string $id The task ID.
     * @return array<string, mixed> Confirmation of reopening.
     *
     * @throws RuntimeException If the request fails.
     */
    public function reopenTask(string $id): array
    {
        $this->request('POST', self::REST_V2_PREFIX . "/tasks/{$id}/reopen");

        return ['reopened' => true, 'id' => $id];
    }

    /**
     * List tasks with optional filtering.
     *
     * @param array<string, mixed> $params Filter parameters (project_id, section_id, label, filter, lang, ids).
     * @return array<int, array<string, mixed>> Array of task objects.
     *
     * @throws RuntimeException If the request fails.
     */
    public function listTasks(array $params = []): array
    {
        return $this->request('GET', self::REST_V2_PREFIX . '/tasks', $params);
    }

    /**
     * Quick-add a task using Todoist's natural language parser.
     *
     * @param string $text    Natural language task text (e.g., "Buy milk tomorrow @Groceries").
     * @param string $note    Optional note to attach to the task.
     * @param string $reminder Optional reminder in natural language.
     * @param bool   $autoReminder Whether to add an automatic reminder.
     * @return array<string, mixed> The created task object.
     *
     * @throws RuntimeException If the request fails.
     */
    public function quickAdd(string $text, string $note = '', string $reminder = '', bool $autoReminder = false): array
    {
        $body = ['text' => $text];

        if ($note !== '') {
            $body['note'] = $note;
        }
        if ($reminder !== '') {
            $body['reminder'] = $reminder;
        }
        if ($autoReminder) {
            $body['auto_reminder'] = true;
        }

        return $this->request('POST', self::QUICK_ADD_URL, $body);
    }

    // ─── Projects ──────────────────────────────────────────────────────────

    /**
     * Create a new project.
     *
     * @param array<string, mixed> $params Project properties (name, parent_id, color, is_favorite, view_style).
     * @return array<string, mixed> The created project object.
     *
     * @throws RuntimeException If the request fails.
     */
    public function createProject(array $params): array
    {
        return $this->request('POST', self::REST_V2_PREFIX . '/projects', $params);
    }

    /**
     * Retrieve a single project by its ID.
     *
     * @param string $id The project ID.
     * @return array<string, mixed> The project object.
     *
     * @throws RuntimeException If the request fails.
     */
    public function getProject(string $id): array
    {
        return $this->request('GET', self::REST_V2_PREFIX . "/projects/{$id}");
    }

    /**
     * Update an existing project.
     *
     * @param string $id The project ID.
     * @param array<string, mixed> $params Fields to update (name, color, is_favorite, view_style).
     * @return array<string, mixed> The updated project object.
     *
     * @throws RuntimeException If the request fails.
     */
    public function updateProject(string $id, array $params): array
    {
        return $this->request('POST', self::REST_V2_PREFIX . "/projects/{$id}", $params);
    }

    /**
     * Delete a project permanently.
     *
     * @param string $id The project ID.
     * @return array<string, mixed> Confirmation of deletion.
     *
     * @throws RuntimeException If the request fails.
     */
    public function deleteProject(string $id): array
    {
        $this->request('DELETE', self::REST_V2_PREFIX . "/projects/{$id}");

        return ['deleted' => true, 'id' => $id];
    }

    /**
     * List all projects accessible to the authenticated user.
     *
     * @return array<int, array<string, mixed>> Array of project objects.
     *
     * @throws RuntimeException If the request fails.
     */
    public function listProjects(): array
    {
        return $this->request('GET', self::REST_V2_PREFIX . '/projects');
    }

    // ─── Sections ──────────────────────────────────────────────────────────

    /**
     * Create a new section within a project.
     *
     * @param array<string, mixed> $params Section properties (name, project_id, order).
     * @return array<string, mixed> The created section object.
     *
     * @throws RuntimeException If the request fails.
     */
    public function createSection(array $params): array
    {
        return $this->request('POST', self::REST_V2_PREFIX . '/sections', $params);
    }

    /**
     * Retrieve a single section by its ID.
     *
     * @param string $id The section ID.
     * @return array<string, mixed> The section object.
     *
     * @throws RuntimeException If the request fails.
     */
    public function getSection(string $id): array
    {
        return $this->request('GET', self::REST_V2_PREFIX . "/sections/{$id}");
    }

    /**
     * Delete a section permanently.
     *
     * @param string $id The section ID.
     * @return array<string, mixed> Confirmation of deletion.
     *
     * @throws RuntimeException If the request fails.
     */
    public function deleteSection(string $id): array
    {
        $this->request('DELETE', self::REST_V2_PREFIX . "/sections/{$id}");

        return ['deleted' => true, 'id' => $id];
    }

    /**
     * List sections, optionally filtered by project.
     *
     * @param string|null $projectId Optional project ID to filter sections.
     * @return array<int, array<string, mixed>> Array of section objects.
     *
     * @throws RuntimeException If the request fails.
     */
    public function listSections(?string $projectId = null): array
    {
        $params = [];
        if ($projectId !== null) {
            $params['project_id'] = $projectId;
        }

        return $this->request('GET', self::REST_V2_PREFIX . '/sections', $params);
    }

    // ─── Comments ──────────────────────────────────────────────────────────

    /**
     * Create a comment on a task or project.
     *
     * @param array<string, mixed> $params Comment properties (task_id or project_id, content).
     * @return array<string, mixed> The created comment object.
     *
     * @throws RuntimeException If the request fails.
     */
    public function createComment(array $params): array
    {
        return $this->request('POST', self::REST_V2_PREFIX . '/comments', $params);
    }

    /**
     * List comments for a task or project.
     *
     * @param string|null $taskId    Optional task ID to list comments for.
     * @param string|null $projectId Optional project ID to list comments for.
     * @return array<int, array<string, mixed>> Array of comment objects.
     *
     * @throws RuntimeException If the request fails.
     */
    public function listComments(?string $taskId = null, ?string $projectId = null): array
    {
        $params = [];
        if ($taskId !== null) {
            $params['task_id'] = $taskId;
        }
        if ($projectId !== null) {
            $params['project_id'] = $projectId;
        }

        return $this->request('GET', self::REST_V2_PREFIX . '/comments', $params);
    }

    // ─── Labels ────────────────────────────────────────────────────────────

    /**
     * List all personal labels for the authenticated user.
     *
     * @return array<int, array<string, mixed>> Array of label objects.
     *
     * @throws RuntimeException If the request fails.
     */
    public function listLabels(): array
    {
        return $this->request('GET', self::REST_V2_PREFIX . '/labels');
    }

    // ─── HTTP Helpers ──────────────────────────────────────────────────────

    /**
     * Send an authenticated request to the Todoist API.
     *
     * @param string               $method HTTP method (GET, POST, DELETE).
     * @param string               $path   API path (e.g., '/rest/v2/tasks', '/sync/v9/user').
     * @param array<string, mixed> $params Query parameters (GET) or JSON body (POST).
     * @return array<string, mixed> Decoded JSON response.
     *
     * @throws RuntimeException If the API returns an error.
     */
    private function request(string $method, string $path, array $params = []): array
    {
        if (!$this->accessToken) {
            throw new RuntimeException('Todoist access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                'POST' => $http->post($url, $params),
                'DELETE' => $http->delete($url),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                Log::error('Todoist API error', [
                    'method' => $method,
                    'url' => $url,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                throw new RuntimeException(
                    "Todoist API error ({$response->status()}): {$response->body()}"
                );
            }

            $json = $response->json();

            return is_array($json) ? $json : ['result' => $json];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Todoist API connection error', [
                'method' => $method,
                'url' => $url,
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Todoist API: {$e->getMessage()}");
        }
    }
}
