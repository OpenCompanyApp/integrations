<?php

namespace OpenCompany\Integrations\Wrike;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Wrike REST API v4.
 *
 * Wraps HTTP calls to Wrike's REST endpoints for tasks, folders,
 * spaces, contacts, and comments.
 *
 * Authentication uses an OAuth2 access token or permanent token sent
 * as a Bearer header.  Responses are wrapped in a top-level `data` key
 * and pagination is token-based via the `nextPageToken` field.
 */
class WrikeService
{
    private const BASE_URL = 'https://www.wrike.com/api/v4';

    /**
     * @param  string  $accessToken  Wrike OAuth2 access token or permanent token
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
        return $this->request('GET', '/user');
    }

    // ── Tasks ───────────────────────────────────────────────

    /**
     * List tasks with optional filters.
     *
     * @param  array<string, mixed>  $params  Query params (folderId, spaceId, status, limit, pageToken)
     * @return array<string, mixed>
     */
    public function listTasks(array $params = []): array
    {
        return $this->request('GET', '/tasks', $params);
    }

    /**
     * Get a task by ID.
     *
     * @param  string  $id  Task ID
     * @return array<string, mixed>
     */
    public function getTask(string $id): array
    {
        return $this->request('GET', "/tasks/{$id}");
    }

    /**
     * Create a new task in a folder.
     *
     * @param  string                 $folderId  The folder to create the task in
     * @param  array<string, mixed>   $data      Task fields (title, description, importance, dates, responsibles)
     * @return array<string, mixed>
     */
    public function createTask(string $folderId, array $data): array
    {
        return $this->request('POST', "/folders/{$folderId}/tasks", $data);
    }

    /**
     * Update a task.
     *
     * @param  string                 $id    Task ID
     * @param  array<string, mixed>   $data  Fields to update (title, description, status, importance, dates)
     * @return array<string, mixed>
     */
    public function updateTask(string $id, array $data): array
    {
        return $this->request('PUT', "/tasks/{$id}", $data);
    }

    // ── Folders ─────────────────────────────────────────────

    /**
     * List folders with optional filters.
     *
     * @param  array<string, mixed>  $params  Query params (spaceId, limit, pageToken)
     * @return array<string, mixed>
     */
    public function listFolders(array $params = []): array
    {
        return $this->request('GET', '/folders', $params);
    }

    /**
     * Get a folder by ID.
     *
     * @param  string  $id  Folder ID
     * @return array<string, mixed>
     */
    public function getFolder(string $id): array
    {
        return $this->request('GET', "/folders/{$id}");
    }

    /**
     * Create a new folder.
     *
     * @param  array<string, mixed>  $data  Folder fields (title, parent, description)
     * @return array<string, mixed>
     */
    public function createFolder(array $data): array
    {
        return $this->request('POST', '/folders', $data);
    }

    // ── Spaces ──────────────────────────────────────────────

    /**
     * List spaces with optional filters.
     *
     * @param  array<string, mixed>  $params  Query params (limit)
     * @return array<string, mixed>
     */
    public function listSpaces(array $params = []): array
    {
        return $this->request('GET', '/spaces', $params);
    }

    /**
     * Get a space by ID.
     *
     * @param  string  $id  Space ID
     * @return array<string, mixed>
     */
    public function getSpace(string $id): array
    {
        return $this->request('GET', "/spaces/{$id}");
    }

    // ── Contacts ────────────────────────────────────────────

    /**
     * List contacts with optional filters.
     *
     * @param  array<string, mixed>  $params  Query params (limit)
     * @return array<string, mixed>
     */
    public function listContacts(array $params = []): array
    {
        return $this->request('GET', '/contacts', $params);
    }

    // ── Comments ────────────────────────────────────────────

    /**
     * Add a comment to a task.
     *
     * @param  string  $taskId  Task ID
     * @param  string  $text    Comment text
     * @return array<string, mixed>
     */
    public function addComment(string $taskId, string $text): array
    {
        return $this->request('POST', "/tasks/{$taskId}/comments", [
            'text' => $text,
        ]);
    }

    // ── User ────────────────────────────────────────────────

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to Wrike.
     *
     * Sends the Bearer token in the Authorization header.  For POST/PUT
     * requests the payload is sent as JSON.  For GET requests the params
     * are sent as query parameters.  The response is extracted from the
     * top-level `data` key.
     *
     * @param  string                 $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string                 $path    API path (e.g. /tasks)
     * @param  array<string, mixed>   $data    Query or body params
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Wrike access token is not configured.');
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
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'DELETE' => $http->delete($url),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                Log::error("Wrike API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);

                throw new \RuntimeException("Wrike API error ({$response->status()}): {$response->body()}");
            }

            return $response->json('data') ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Wrike API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Wrike API: {$e->getMessage()}");
        }
    }
}
