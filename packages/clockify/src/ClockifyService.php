<?php

namespace OpenCompany\Integrations\Clockify;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Clockify API service — handles authenticated HTTP requests to the Clockify REST API.
 *
 * Uses Bearer token authentication. Supports all standard HTTP methods
 * and returns parsed JSON responses.
 */
class ClockifyService
{
    /**
     * @param string $apiKey  Clockify API key (Bearer token)
     * @param string $baseUrl Base URL for the Clockify API
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.clockify.me/api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has been configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    // ── User ──────────────────────────────────────────────────────────────

    /**
     * Get the currently authenticated user.
     *
     * @return array User profile data
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    // ── Workspaces ────────────────────────────────────────────────────────

    /**
     * List all workspaces the authenticated user belongs to.
     *
     * @return array List of workspace objects
     */
    public function listWorkspaces(): array
    {
        return $this->request('GET', '/workspaces');
    }

    /**
     * Get a single workspace by ID.
     *
     * @param string $workspaceId Workspace ID
     * @return array Workspace object
     */
    public function getWorkspace(string $workspaceId): array
    {
        return $this->request('GET', '/workspaces/' . urlencode($workspaceId));
    }

    // ── Projects ──────────────────────────────────────────────────────────

    /**
     * List projects in a workspace.
     *
     * @param string   $workspaceId Workspace ID
     * @param string   $name        Filter by project name (partial match)
     * @param int      $page        Page number (1-based)
     * @param int      $pageSize    Items per page
     * @return array List of project objects
     */
    public function listProjects(
        string $workspaceId,
        string $name = '',
        int $page = 1,
        int $pageSize = 50,
    ): array {
        $params = [
            'page' => $page,
            'page-size' => $pageSize,
        ];
        if ($name !== '') {
            $params['name'] = $name;
        }

        return $this->request(
            'GET',
            '/workspaces/' . urlencode($workspaceId) . '/projects',
            $params,
        );
    }

    /**
     * Get a single project by ID.
     *
     * @param string $workspaceId Workspace ID
     * @param string $projectId   Project ID
     * @return array Project object
     */
    public function getProject(string $workspaceId, string $projectId): array
    {
        return $this->request(
            'GET',
            '/workspaces/' . urlencode($workspaceId) . '/projects/' . urlencode($projectId),
        );
    }

    /**
     * Create a new project in a workspace.
     *
     * @param string $workspaceId Workspace ID
     * @param string $name        Project name
     * @param string $color       Hex color code (e.g. "#ff0000")
     * @param bool   $isPublic    Whether the project is publicly visible
     * @return array Created project object
     */
    public function createProject(
        string $workspaceId,
        string $name,
        string $color = '#03a9f4',
        bool $isPublic = false,
    ): array {
        return $this->request(
            'POST',
            '/workspaces/' . urlencode($workspaceId) . '/projects',
            [
                'name' => $name,
                'color' => $color,
                'isPublic' => $isPublic,
            ],
        );
    }

    // ── Time Entries ──────────────────────────────────────────────────────

    /**
     * List time entries in a workspace.
     *
     * @param string      $workspaceId Workspace ID
     * @param string|null $start       Start date filter (ISO 8601, e.g. "2026-01-01T00:00:00Z")
     * @param string|null $end         End date filter (ISO 8601)
     * @param string|null $project     Filter by project ID
     * @param int         $page        Page number (1-based)
     * @param int         $pageSize    Items per page
     * @return array List of time entry objects
     */
    public function listTimeEntries(
        string $workspaceId,
        ?string $start = null,
        ?string $end = null,
        ?string $project = null,
        int $page = 1,
        int $pageSize = 50,
    ): array {
        $params = [
            'page' => $page,
            'page-size' => $pageSize,
        ];
        if ($start !== null) {
            $params['start'] = $start;
        }
        if ($end !== null) {
            $params['end'] = $end;
        }
        if ($project !== null) {
            $params['project'] = $project;
        }

        return $this->request(
            'GET',
            '/workspaces/' . urlencode($workspaceId) . '/time-entries',
            $params,
        );
    }

    /**
     * Get a single time entry by ID.
     *
     * @param string $workspaceId  Workspace ID
     * @param string $timeEntryId  Time entry ID
     * @return array Time entry object
     */
    public function getTimeEntry(string $workspaceId, string $timeEntryId): array
    {
        return $this->request(
            'GET',
            '/workspaces/' . urlencode($workspaceId) . '/time-entries/' . urlencode($timeEntryId),
        );
    }

    /**
     * Create a new time entry in a workspace.
     *
     * @param string      $workspaceId Workspace ID
     * @param string      $start       Start time (ISO 8601, e.g. "2026-04-05T09:00:00Z")
     * @param string      $end         End time (ISO 8601)
     * @param string      $description Description of the time entry
     * @param string|null $projectId   Optional project ID to assign
     * @return array Created time entry object
     */
    public function createTimeEntry(
        string $workspaceId,
        string $start,
        string $end,
        string $description = '',
        ?string $projectId = null,
    ): array {
        $data = [
            'start' => $start,
            'end' => $end,
            'description' => $description,
        ];
        if ($projectId !== null) {
            $data['projectId'] = $projectId;
        }

        return $this->request(
            'POST',
            '/workspaces/' . urlencode($workspaceId) . '/time-entries',
            $data,
        );
    }

    /**
     * Update an existing time entry.
     *
     * @param string $workspaceId  Workspace ID
     * @param string $timeEntryId  Time entry ID
     * @param array  $data         Fields to update (start, end, description, projectId, etc.)
     * @return array Updated time entry object
     */
    public function updateTimeEntry(string $workspaceId, string $timeEntryId, array $data): array
    {
        return $this->request(
            'PUT',
            '/workspaces/' . urlencode($workspaceId) . '/time-entries/' . urlencode($timeEntryId),
            $data,
        );
    }

    /**
     * Delete a time entry.
     *
     * @param string $workspaceId Workspace ID
     * @param string $timeEntryId Time entry ID
     */
    public function deleteTimeEntry(string $workspaceId, string $timeEntryId): void
    {
        $this->request(
            'DELETE',
            '/workspaces/' . urlencode($workspaceId) . '/time-entries/' . urlencode($timeEntryId),
        );
    }

    // ── Tasks ─────────────────────────────────────────────────────────────

    /**
     * List tasks for a project.
     *
     * @param string $workspaceId Workspace ID
     * @param string $projectId   Project ID
     * @param int    $page        Page number (1-based)
     * @param int    $pageSize    Items per page
     * @return array List of task objects
     */
    public function listTasks(
        string $workspaceId,
        string $projectId,
        int $page = 1,
        int $pageSize = 50,
    ): array {
        return $this->request(
            'GET',
            '/workspaces/' . urlencode($workspaceId) . '/projects/' . urlencode($projectId) . '/tasks',
            [
                'page' => $page,
                'page-size' => $pageSize,
            ],
        );
    }

    // ── HTTP layer ────────────────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE)
     * @param string $path   API path (e.g. "/workspaces")
     * @param array  $data   Query params (GET) or body (POST/PUT/DELETE)
     * @return array Parsed JSON response
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Clockify API.
     *
     * @param string $method HTTP method
     * @param string $path   API path
     * @param array  $data   Query params or request body
     * @return \Illuminate\Http\Client\Response Raw HTTP response
     *
     * @throws \RuntimeException On connection failure or API error
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Clockify API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withToken($this->apiKey)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->body();
                Log::error("Clockify API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $error,
                ]);
                throw new \RuntimeException(
                    "Clockify API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)),
                );
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Clockify API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Clockify API: {$e->getMessage()}");
        }
    }
}
