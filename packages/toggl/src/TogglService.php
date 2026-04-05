<?php

namespace OpenCompany\Integrations\Toggl;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Toggl Track API service — handles authentication and HTTP communication.
 *
 * Uses HTTP Basic Auth with the Toggl API token as username and "api_token"
 * as the password, as required by the Toggl Track v9 API.
 *
 * @see https://engineering.toggl.com/docs/
 */
class TogglService
{
    /**
     * Create a new TogglService instance.
     *
     * @param string $apiToken Toggl Track API token (found at https://track.toggl.com/profile)
     * @param string $baseUrl  Base URL for the Toggl Track API
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://api.track.toggl.com/api/v9',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API token.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiToken);
    }

    /**
     * Get the current user's profile.
     *
     * @return array The authenticated user's profile data
     *
     * @see https://engineering.toggl.com/docs/api/me#get-me
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    /**
     * List all workspaces the authenticated user has access to.
     *
     * @return array<int, array> List of workspace objects
     *
     * @see https://engineering.toggl.com/docs/api/workspaces#get-workspaces
     */
    public function listWorkspaces(): array
    {
        return $this->request('GET', '/me/workspaces');
    }

    /**
     * List all projects in a workspace.
     *
     * @param int $workspaceId The workspace ID
     *
     * @return array<int, array> List of project objects
     *
     * @see https://engineering.toggl.com/docs/api/projects#get-projects
     */
    public function listProjects(int $workspaceId): array
    {
        return $this->request('GET', "/workspaces/{$workspaceId}/projects");
    }

    /**
     * Create a new project in a workspace.
     *
     * @param int   $workspaceId The workspace ID
     * @param array $data        Project data (name, color, billable, etc.)
     *
     * @return array The created project object
     *
     * @see https://engineering.toggl.com/docs/api/projects#post-project
     */
    public function createProject(int $workspaceId, array $data): array
    {
        return $this->request('POST', "/workspaces/{$workspaceId}/projects", $data);
    }

    /**
     * List time entries for the authenticated user.
     *
     * @param string|null $startDate Start date in ISO 8601 format (e.g., "2026-01-01")
     * @param string|null $endDate   End date in ISO 8601 format (e.g., "2026-01-31")
     *
     * @return array<int, array> List of time entry objects
     *
     * @see https://engineering.toggl.com/docs/api/time_entries#get-timeentries
     */
    public function listTimeEntries(?string $startDate = null, ?string $endDate = null): array
    {
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
     * Create a new time entry in a workspace.
     *
     * @param int   $workspaceId The workspace ID
     * @param array $data        Time entry data (description, start, stop, duration, project_id, etc.)
     *
     * @return array The created time entry object
     *
     * @see https://engineering.toggl.com/docs/api/time_entries#post-timeentry
     */
    public function createTimeEntry(int $workspaceId, array $data): array
    {
        return $this->request('POST', "/workspaces/{$workspaceId}/time_entries", $data);
    }

    /**
     * Update an existing time entry.
     *
     * @param int   $workspaceId   The workspace ID
     * @param int   $timeEntryId   The time entry ID
     * @param array $data          Updated time entry data
     *
     * @return array The updated time entry object
     *
     * @see https://engineering.toggl.com/docs/api/time_entries#put-timeentry
     */
    public function updateTimeEntry(int $workspaceId, int $timeEntryId, array $data): array
    {
        return $this->request('PUT', "/workspaces/{$workspaceId}/time_entries/{$timeEntryId}", $data);
    }

    /**
     * Delete a time entry.
     *
     * @param int $workspaceId The workspace ID
     * @param int $timeEntryId The time entry ID
     *
     * @see https://engineering.toggl.com/docs/api/time_entries#delete-timeentry
     */
    public function deleteTimeEntry(int $workspaceId, int $timeEntryId): void
    {
        $this->request('DELETE', "/workspaces/{$workspaceId}/time_entries/{$timeEntryId}");
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE)
     * @param string $path   API path relative to the base URL
     * @param array  $data   Request body (for POST/PUT) or query params (for GET)
     *
     * @return array Parsed JSON response body
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($method === 'DELETE') {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Toggl Track API.
     *
     * Authenticates using HTTP Basic Auth with the API token as the username
     * and the literal string "api_token" as the password.
     *
     * @param string $method HTTP method
     * @param string $path   API path
     * @param array  $data   Request data
     *
     * @return \Illuminate\Http\Client\Response The raw HTTP response
     *
     * @throws \RuntimeException If the API token is missing or the request fails
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (! $this->apiToken) {
            throw new \RuntimeException('Toggl API token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withBasicAuth($this->apiToken, 'api_token')
              ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $error = $response->json('message') ?? $response->body();
                Log::error("Toggl API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $error,
                ]);
                throw new \RuntimeException(
                    "Toggl API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error))
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
