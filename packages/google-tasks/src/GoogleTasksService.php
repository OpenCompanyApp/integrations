<?php

namespace OpenCompany\Integrations\GoogleTasks;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleTasksService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://tasks.googleapis.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all task lists for the authenticated user.
     *
     * @param  int|null  $maxResults  Maximum number of task lists to return (default: 20, max: 100).
     * @param  string|null  $pageToken  Token for the next page of results.
     * @return array<string, mixed>
     */
    public function listTaskLists(?int $maxResults = null, ?string $pageToken = null): array
    {
        $params = [];
        if ($maxResults !== null) {
            $params['maxResults'] = $maxResults;
        }
        if ($pageToken !== null) {
            $params['pageToken'] = $pageToken;
        }

        return $this->request('GET', '/tasks/v1/users/@me/lists', $params);
    }

    /**
     * Get a specific task list by ID.
     *
     * @param  string  $taskListId  The task list ID.
     * @return array<string, mixed>
     */
    public function getTaskList(string $taskListId): array
    {
        return $this->request('GET', '/tasks/v1/users/@me/lists/' . urlencode($taskListId));
    }

    /**
     * Create a new task list.
     *
     * @param  string  $title  The title of the task list.
     * @return array<string, mixed>
     */
    public function createTaskList(string $title): array
    {
        return $this->request('POST', '/tasks/v1/users/@me/lists', [
            'title' => $title,
        ]);
    }

    /**
     * List tasks in a given task list.
     *
     * @param  string  $taskListId  The task list ID.
     * @param  int|null  $maxResults  Maximum number of tasks to return (default: 20, max: 100).
     * @param  string|null  $pageToken  Token for the next page of results.
     * @param  bool|null  $showCompleted  Whether to include completed tasks (default: true).
     * @param  string|null  $dueDate  ISO 8601 date to filter tasks due before this date (e.g., "2026-04-30T00:00:00.000Z").
     * @return array<string, mixed>
     */
    public function listTasks(
        string $taskListId,
        ?int $maxResults = null,
        ?string $pageToken = null,
        ?bool $showCompleted = null,
        ?string $dueDate = null,
    ): array {
        $params = [];
        if ($maxResults !== null) {
            $params['maxResults'] = $maxResults;
        }
        if ($pageToken !== null) {
            $params['pageToken'] = $pageToken;
        }
        if ($showCompleted !== null) {
            $params['showCompleted'] = $showCompleted ? 'true' : 'false';
        }
        if ($dueDate !== null) {
            $params['dueMax'] = $dueDate;
        }

        return $this->request('GET', '/tasks/v1/lists/' . urlencode($taskListId) . '/tasks', $params);
    }

    /**
     * Get a specific task by ID from a task list.
     *
     * @param  string  $taskListId  The task list ID.
     * @param  string  $taskId  The task ID.
     * @return array<string, mixed>
     */
    public function getTask(string $taskListId, string $taskId): array
    {
        return $this->request(
            'GET',
            '/tasks/v1/lists/' . urlencode($taskListId) . '/tasks/' . urlencode($taskId),
        );
    }

    /**
     * Create a new task in a task list.
     *
     * @param  string  $taskListId  The task list ID.
     * @param  string  $title  The title of the task.
     * @param  string|null  $notes  Notes/description for the task.
     * @param  string|null  $due  Due date in RFC 3339 format (e.g., "2026-04-30T00:00:00.000Z").
     * @return array<string, mixed>
     */
    public function createTask(
        string $taskListId,
        string $title,
        ?string $notes = null,
        ?string $due = null,
    ): array {
        $body = ['title' => $title];
        if ($notes !== null) {
            $body['notes'] = $notes;
        }
        if ($due !== null) {
            $body['due'] = $due;
        }

        return $this->request(
            'POST',
            '/tasks/v1/lists/' . urlencode($taskListId) . '/tasks',
            $body,
        );
    }

    /**
     * Get the current authenticated user's information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/tasks/v1/users/@me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed>
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
     * Make a raw HTTP request to the Google Tasks API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Google Tasks access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
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
                $error = $response->json('error.message') ?? $response->body();
                Log::error("Google Tasks API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Google Tasks API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Google Tasks API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Google Tasks API: {$e->getMessage()}");
        }
    }
}
