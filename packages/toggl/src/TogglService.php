<?php

namespace OpenCompany\Integrations\Toggl;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Toggl API service — handles authenticated HTTP requests to the Toggl Track REST API.
 *
 * Uses HTTP Basic Auth with the API token as username and 'api_token' as password.
 * Supports all standard HTTP methods and returns parsed JSON responses.
 */
class TogglService
{
    /**
     * @param string $apiToken Toggl API token (used as username in Basic Auth)
     * @param string $baseUrl  Base URL for the Toggl Track API
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://api.track.toggl.com/api/v9',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has been configured with an API token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiToken);
    }

    // ── User ──────────────────────────────────────────────────────────────

    /**
     * Get the currently authenticated user.
     *
     * @return array User profile data
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    // ── Workspaces ────────────────────────────────────────────────────────

    /**
     * List all workspaces the authenticated user belongs to.
     *
     * @return array List of workspace objects
     */
    public function listWorkspaces(): array
    {
        return $this->request('GET', '/me/workspaces');
    }

    // ── Projects ──────────────────────────────────────────────────────────

    /**
     * List projects in a workspace.
     *
     * @param string $workspaceId Workspace ID
     * @param bool   $active      Filter for active projects only
     * @return array List of project objects
     */
    public function listProjects(
        string $workspaceId,
        bool $active = true,
    ): array {
        $params = [];
        if ($active) {
            $params['active'] = 'true';
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

    // ── Time Entries ──────────────────────────────────────────────────────

    /**
     * List time entries.
     *
     * @param string|null $startDate Start date filter (ISO 8601 date, e.g. "2026-01-01")
     * @param string|null $endDate   End date filter (ISO 8601 date)
     * @return array List of time entry objects
     */
    public function listTimeEntries(
        ?string $startDate = null,
        ?string $endDate = null,
    ): array {
        $params = [];
        if ($startDate !== null) {
            $params['start_date'] = $startDate;
        }
        if ($endDate !== null) {
            $params['end_date'] = $endDate;
        }

        return $this->request('GET', '/me/time_entries', $params);
    }

    /**
     * Get a single time entry by ID.
     *
     * @param string $timeEntryId Time entry ID
     * @return array Time entry object
     */
    public function getTimeEntry(string $timeEntryId): array
    {
        return $this->request(
            'GET',
            '/me/time_entries/' . urlencode($timeEntryId),
        );
    }

    /**
     * Create a new time entry.
     *
     * @param string      $workspaceId  Workspace ID
     * @param string      $description  Description of the time entry
     * @param array       $tags         Tags for the time entry
     * @param string      $duration     Duration in seconds (or -1 for running timer)
     * @param string      $start        Start time (ISO 8601, e.g. "2026-04-05T09:00:00Z")
     * @param string|null $stop         Stop time (ISO 8601, omit for running timer)
     * @param string|null $projectId    Optional project ID to assign
     * @param string      $createdWith  Source identifier (required by Toggl API)
     * @return array Created time entry object
     */
    public function createTimeEntry(
        string $workspaceId,
        string $description = '',
        array $tags = [],
        string $duration = '-1',
        string $start = '',
        ?string $stop = null,
        ?string $projectId = null,
        string $createdWith = 'opencompany',
    ): array {
        $data = [
            'description' => $description,
            'tags' => $tags,
            'duration' => (int) $duration,
            'start' => $start ?: now()->toIso8601ZuluString(),
            'created_with' => $createdWith,
            'workspace_id' => (int) $workspaceId,
        ];
        if ($stop !== null) {
            $data['stop'] = $stop;
        }
        if ($projectId !== null) {
            $data['project_id'] = (int) $projectId;
        }

        return $this->request(
            'POST',
            '/workspaces/' . urlencode($workspaceId) . '/time_entries',
            $data,
        );
    }

    // ── HTTP layer ────────────────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE)
     * @param string $path   API path (e.g. "/me/workspaces")
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
     * Make a raw HTTP request to the Toggl API.
     *
     * Uses HTTP Basic Auth with the API token as username and 'api_token' as password.
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
        if (!$this->apiToken) {
            throw new \RuntimeException('Toggl API token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withBasicAuth($this->apiToken, 'api_token')
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
                Log::error("Toggl API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $error,
                ]);
                throw new \RuntimeException(
                    "Toggl API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)),
                );
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Toggl API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Toggl API: {$e->getMessage()}");
        }
    }
}
