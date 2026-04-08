<?php

namespace OpenCompany\Integrations\Harvest;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Harvest REST API v2.
 *
 * Wraps HTTP calls to Harvest's endpoints for time entries, projects,
 * clients, tasks, and users. Uses Bearer token authentication with
 * an account ID header on every request.
 */
class HarvestService
{
    private const BASE_URL = 'https://api.harvestapp.com/v2';

    /**
     * @param  string  $accessToken  Harvest personal access token or OAuth2 bearer token
     * @param  string  $accountId    Harvest account ID (sent as Harvest-Account-Id header)
     */
    public function __construct(
        private string $accessToken = '',
        private string $accountId = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->accessToken) && ! empty($this->accountId);
    }

    // ── Connection Test ─────────────────────────────────────

    /**
     * Test the connection by fetching the current user.
     *
     * @return array<string, mixed>
     */
    public function testConnection(): array
    {
        return $this->request('GET', '/users/me');
    }

    // ── Time Entries ────────────────────────────────────────

    /**
     * List time entries with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters (user_id, client_id, project_id, is_billed, is_running, from, to, page, per_page)
     * @return array<string, mixed>
     */
    public function listTimeEntries(array $params = []): array
    {
        return $this->request('GET', '/time_entries', $params);
    }

    /**
     * Create a new time entry.
     *
     * @param  array<string, mixed>  $data  Time entry fields (project_id, task_id, spent_date, hours, notes, timer_started_at)
     * @return array<string, mixed>
     */
    public function createTimeEntry(array $data): array
    {
        return $this->request('POST', '/time_entries', $data);
    }

    /**
     * Get a single time entry by ID.
     *
     * @param  int|string  $id  Time entry ID
     * @return array<string, mixed>
     */
    public function getTimeEntry(int|string $id): array
    {
        return $this->request('GET', '/time_entries/' . $id);
    }

    /**
     * Update an existing time entry.
     *
     * @param  int|string  $id  Time entry ID
     * @param  array<string, mixed>  $data  Fields to update (hours, notes, spent_date)
     * @return array<string, mixed>
     */
    public function updateTimeEntry(int|string $id, array $data): array
    {
        return $this->request('PATCH', '/time_entries/' . $id, $data);
    }

    /**
     * Delete a time entry.
     *
     * @param  int|string  $id  Time entry ID
     * @return array<string, mixed>
     */
    public function deleteTimeEntry(int|string $id): array
    {
        return $this->request('DELETE', '/time_entries/' . $id);
    }

    // ── Projects ────────────────────────────────────────────

    /**
     * List projects with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters (client_id, is_active, page, per_page)
     * @return array<string, mixed>
     */
    public function listProjects(array $params = []): array
    {
        return $this->request('GET', '/projects', $params);
    }

    /**
     * Get a single project by ID.
     *
     * @param  int|string  $id  Project ID
     * @return array<string, mixed>
     */
    public function getProject(int|string $id): array
    {
        return $this->request('GET', '/projects/' . $id);
    }

    // ── Clients ─────────────────────────────────────────────

    /**
     * List clients with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters (is_active, page)
     * @return array<string, mixed>
     */
    public function listClients(array $params = []): array
    {
        return $this->request('GET', '/clients', $params);
    }

    // ── Tasks ───────────────────────────────────────────────

    /**
     * List tasks with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters (is_active, page)
     * @return array<string, mixed>
     */
    public function listTasks(array $params = []): array
    {
        return $this->request('GET', '/tasks', $params);
    }

    // ── Users ───────────────────────────────────────────────

    /**
     * List users with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters (is_active, page, per_page)
     * @return array<string, mixed>
     */
    public function listUsers(array $params = []): array
    {
        return $this->request('GET', '/users', $params);
    }

    /**
     * Get a single user by ID.
     *
     * @param  int|string  $id  User ID
     * @return array<string, mixed>
     */
    public function getUser(int|string $id): array
    {
        return $this->request('GET', '/users/' . $id);
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

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to Harvest.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, DELETE)
     * @param  string  $path    API path (e.g. /time_entries)
     * @param  array<string, mixed>  $data  Query parameters or request body
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->accessToken || ! $this->accountId) {
            throw new \RuntimeException('Harvest access token and account ID are not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Harvest-Account-Id' => $this->accountId,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PATCH'  => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->failed()) {
                Log::error("Harvest API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);

                throw new \RuntimeException(
                    'Harvest API error (' . $response->status() . '): ' . $response->body()
                );
            }

            $body = $response->json() ?? [];

            // Attach pagination metadata from Harvest response headers
            $totalPages  = $response->header('Total-Pages');
            $totalEntries = $response->header('Total-Entries');
            $page        = $response->header('Page');
            $perPage     = $response->header('Per-Page');

            if ($totalPages !== null) {
                $body['_pagination'] = [
                    'page'          => $page !== null ? (int) $page : null,
                    'per_page'      => $perPage !== null ? (int) $perPage : null,
                    'total_pages'   => $totalPages !== null ? (int) $totalPages : null,
                    'total_entries' => $totalEntries !== null ? (int) $totalEntries : null,
                ];
            }

            return $body;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Harvest API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException('Failed to connect to Harvest API: ' . $e->getMessage());
        }
    }
}
