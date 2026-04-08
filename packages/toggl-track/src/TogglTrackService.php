<?php

namespace OpenCompany\Integrations\TogglTrack;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * TogglTrackService — HTTP client for the Toggl Track API v9.
 *
 * Handles authentication, request execution, error handling, and response
 * parsing for all Toggl Track endpoints used by the integration tools.
 *
 * @see https://developers.track.toggl.com/docs/
 */
class TogglTrackService
{
    /**
     * Create a new TogglTrackService instance.
     *
     * @param  string  $apiToken  The Toggl Track API token used for Bearer authentication.
     * @param  string  $baseUrl   The base URL for the Toggl Track API (default: https://api.track.toggl.com).
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://api.track.toggl.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an API token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiToken);
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed> The user profile data from Toggl Track.
     *
     * @see https://developers.track.toggl.com/docs/api/me#get-me
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/v9/me');
    }

    /**
     * List time entries for the authenticated user.
     *
     * @param  array<string, mixed>  $params  Query parameters (start_date, end_date, workspace_id, project_id).
     * @return array<int, array<string, mixed>> List of time entry objects.
     *
     * @see https://developers.track.toggl.com/docs/api/time_entries#get-timeentries
     */
    public function listTimeEntries(array $params = []): array
    {
        return $this->request('GET', '/api/v9/me/time_entries', $params);
    }

    /**
     * Get a single time entry by its ID.
     *
     * @param  int  $id  The time entry ID.
     * @return array<string, mixed> The time entry object.
     *
     * @see https://developers.track.toggl.com/docs/api/time_entries#get-get-a-time-entry
     */
    public function getTimeEntry(int $id): array
    {
        return $this->request('GET', '/api/v9/me/time_entries/' . $id);
    }

    /**
     * Create a new time entry.
     *
     * @param  array<string, mixed>  $data  The time entry data (workspace_id, description, duration, start, pid, tags, billable, created_with).
     * @return array<string, mixed> The created time entry object.
     *
     * @see https://developers.track.toggl.com/docs/api/time_entries#post-timeentries
     */
    public function createTimeEntry(array $data): array
    {
        return $this->request('POST', '/api/v9/me/time_entries', $data);
    }

    /**
     * List projects accessible to the authenticated user.
     *
     * @param  array<string, mixed>  $params  Query parameters (active, workspace_id).
     * @return array<int, array<string, mixed>> List of project objects.
     *
     * @see https://developers.track.toggl.com/docs/api/projects#get-projects
     */
    public function listProjects(array $params = []): array
    {
        return $this->request('GET', '/api/v9/me/projects', $params);
    }

    /**
     * Get a single project by its ID.
     *
     * @param  int  $id  The project ID.
     * @return array<string, mixed> The project object.
     *
     * @see https://developers.track.toggl.com/docs/api/projects#get-project
     */
    public function getProject(int $id): array
    {
        return $this->request('GET', '/api/v9/me/projects/' . $id);
    }

    /**
     * List all workspaces accessible to the authenticated user.
     *
     * @return array<int, array<string, mixed>> List of workspace objects.
     *
     * @see https://developers.track.toggl.com/docs/api/workspaces#get-workspaces
     */
    public function listWorkspaces(): array
    {
        return $this->request('GET', '/api/v9/me/workspaces');
    }

    /**
     * Make an API request and return the parsed JSON response.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g., '/api/v9/me/time_entries').
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed> The parsed JSON response.
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
     * Make a raw HTTP request to the Toggl Track API.
     *
     * Uses HTTP Basic Auth with the API token as the username (Toggl's preferred auth method)
     * or Bearer token authentication.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API token is not configured or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiToken) {
            throw new \RuntimeException('Toggl Track API token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Basic ' . base64_encode($this->apiToken . ':api_token'),
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
                    Log::warning("Toggl Track API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Toggl Track API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Toggl Track API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Toggl Track API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Toggl Track API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Toggl Track API: {$e->getMessage()}");
        }
    }
}
