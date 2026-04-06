<?php

namespace OpenCompany\Integrations\MicrosoftTodo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Microsoft To Do service — wraps the Microsoft Graph API v1.0 for task list and task operations.
 *
 * This service handles authentication (Bearer token), request building, error handling,
 * and response parsing for all Microsoft To Do endpoints used by the integration tools.
 *
 * @see https://learn.microsoft.com/en-us/graph/api/resources/todo-overview
 */
class MicrosoftTodoService
{
    /**
     * Create a new MicrosoftTodoService instance.
     *
     * @param  string  $accessToken  OAuth2 access token for Microsoft Graph.
     * @param  string  $baseUrl  Microsoft Graph API base URL (configurable for testing).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://graph.microsoft.com/v1.0',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has been configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all todo task lists for the authenticated user.
     *
     * @return array The API response containing the list of task lists.
     *
     * @see https://learn.microsoft.com/en-us/graph/api/todo-list-lists
     */
    public function listLists(): array
    {
        return $this->request('GET', '/me/todo/lists');
    }

    /**
     * Get a specific todo task list by ID.
     *
     * @param  string  $id  The unique identifier of the todo task list.
     * @return array The task list resource.
     *
     * @see https://learn.microsoft.com/en-us/graph/api/todotasklist-get
     */
    public function getList(string $id): array
    {
        return $this->request('GET', '/me/todo/lists/' . urlencode($id));
    }

    /**
     * Create a new todo task list.
     *
     * @param  string  $displayName  The name of the new task list.
     * @return array The created task list resource.
     *
     * @see https://learn.microsoft.com/en-us/graph/api/todo-post-lists
     */
    public function createList(string $displayName): array
    {
        return $this->request('POST', '/me/todo/lists', [
            'displayName' => $displayName,
        ]);
    }

    /**
     * List all tasks in a specific todo task list.
     *
     * @param  string  $listId  The unique identifier of the todo task list.
     * @return array The API response containing the list of tasks.
     *
     * @see https://learn.microsoft.com/en-us/graph/api/todotasklist-list-tasks
     */
    public function listTasks(string $listId): array
    {
        return $this->request('GET', '/me/todo/lists/' . urlencode($listId) . '/tasks');
    }

    /**
     * Get a specific task from a todo task list.
     *
     * @param  string  $listId  The unique identifier of the todo task list.
     * @param  string  $taskId  The unique identifier of the task.
     * @return array The task resource.
     *
     * @see https://learn.microsoft.com/en-us/graph/api/todotask-get
     */
    public function getTask(string $listId, string $taskId): array
    {
        return $this->request('GET', '/me/todo/lists/' . urlencode($listId) . '/tasks/' . urlencode($taskId));
    }

    /**
     * Create a new task in a todo task list.
     *
     * @param  string  $listId  The unique identifier of the todo task list.
     * @param  string  $title  The title of the task.
     * @param  string|null  $body  Optional body/content of the task.
     * @param  array|null  $dueDateTime  Optional due date as ['dateTime' => '2026-04-30T00:00:00', 'timeZone' => 'UTC'].
     * @return array The created task resource.
     *
     * @see https://learn.microsoft.com/en-us/graph/api/todotasklist-post-tasks
     */
    public function createTask(string $listId, string $title, ?string $body = null, ?array $dueDateTime = null): array
    {
        $data = [
            'title' => $title,
        ];

        if ($body !== null) {
            $data['body'] = [
                'content' => $body,
                'contentType' => 'text',
            ];
        }

        if ($dueDateTime !== null) {
            $data['dueDateTime'] = $dueDateTime;
        }

        return $this->request('POST', '/me/todo/lists/' . urlencode($listId) . '/tasks', $data);
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array The user resource (displayName, mail, userPrincipalName, etc.).
     *
     * @see https://learn.microsoft.com/en-us/graph/api/user-get
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE, PATCH).
     * @param  string  $path  API path relative to the base URL.
     * @param  array  $data  Request body (POST/PUT/PATCH) or query params (GET).
     * @return array The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Microsoft Graph API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path relative to the base URL.
     * @param  array  $data  Request data.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException When the access token is missing or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Microsoft To Do access token is not configured.');
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
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Microsoft Graph API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Microsoft Graph API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the token may be expired.");
                }

                $error = $response->json('error.message') ?? $response->json('error') ?? $body;
                Log::error("Microsoft Graph API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Microsoft Graph API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Microsoft Graph API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Microsoft Graph API: {$e->getMessage()}");
        }
    }
}
