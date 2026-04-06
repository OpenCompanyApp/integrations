<?php

namespace OpenCompany\Integrations\Basecamp;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * BasecampService — HTTP client for the Basecamp 3 REST API.
 *
 * Handles authentication via Bearer token and provides methods for all
 * Basecamp operations exposed through the integration tools.
 *
 * The base URL is constructed as https://3.basecampapi.com/{account_id}
 * using the account ID from configuration.
 *
 * @see https://github.com/basecamp/api/blob/master/README.md
 */
class BasecampService
{
    /**
     * Create a new BasecampService instance.
     *
     * @param  string  $accessToken  Basecamp OAuth access token.
     * @param  string  $accountId    Basecamp account ID (used in the base URL).
     * @param  string  $baseUrl      Basecamp API base URL (defaults to https://3.basecampapi.com).
     */
    public function __construct(
        private string $accessToken = '',
        private string $accountId = '',
        private string $baseUrl = 'https://3.basecampapi.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has enough configuration to make API calls.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->accountId);
    }

    /**
     * Build the full API base URL including the account ID.
     *
     * @return string  e.g. "https://3.basecampapi.com/1234567"
     */
    private function apiBaseUrl(): string
    {
        return $this->baseUrl . '/' . $this->accountId;
    }

    /**
     * List all projects visible to the authenticated user.
     *
     * @return array<string, mixed>
     *
     * @see https://github.com/basecamp/api/blob/master/sections/projects.md#get-all-projects
     */
    public function listProjects(): array
    {
        return $this->request('GET', '/projects');
    }

    /**
     * Get details for a single project.
     *
     * @param  int  $projectId  The Basecamp project ID.
     * @return array<string, mixed>
     *
     * @see https://github.com/basecamp/api/blob/master/sections/projects.md#get-a-project
     */
    public function getProject(int $projectId): array
    {
        return $this->request('GET', "/projects/{$projectId}");
    }

    /**
     * List to-dos in a specific to-do list.
     *
     * @param  int  $projectId    The Basecamp project ID.
     * @param  int  $todosetId    The to-do set (bucket) ID within the project.
     * @param  int  $todolistId   The specific to-do list ID.
     * @return array<string, mixed>
     *
     * @see https://github.com/basecamp/api/blob/master/sections/todos.md#list-to-dos
     */
    public function listTodos(int $projectId, int $todosetId, int $todolistId): array
    {
        return $this->request('GET', "/projects/{$projectId}/todosets/{$todosetId}/todolists/{$todolistId}/todos");
    }

    /**
     * Create a new to-do in a specific to-do list.
     *
     * @param  int          $projectId     The Basecamp project ID.
     * @param  int          $todosetId     The to-do set (bucket) ID within the project.
     * @param  int          $todolistId    The specific to-do list ID.
     * @param  string       $content       The to-do text.
     * @param  string       $description   Optional extended description (HTML supported).
     * @param  string|null  $dueOn         Optional due date in ISO 8601 format (e.g. "2026-04-30").
     * @param  array<int>|null  $assigneeIds  Optional list of assignee person IDs.
     * @return array<string, mixed>
     *
     * @see https://github.com/basecamp/api/blob/master/sections/todos.md#create-a-to-do
     */
    public function createTodo(
        int $projectId,
        int $todosetId,
        int $todolistId,
        string $content,
        string $description = '',
        ?string $dueOn = null,
        ?array $assigneeIds = null,
    ): array {
        $payload = [
            'content' => $content,
        ];

        if (!empty($description)) {
            $payload['description'] = $description;
        }

        if ($dueOn !== null) {
            $payload['due_on'] = $dueOn;
        }

        if ($assigneeIds !== null) {
            $payload['assignee_ids'] = $assigneeIds;
        }

        return $this->request('POST', "/projects/{$projectId}/todosets/{$todosetId}/todolists/{$todolistId}/todos", $payload);
    }

    /**
     * List messages (message board posts) for a project.
     *
     * @param  int  $projectId  The Basecamp project ID.
     * @return array<string, mixed>
     *
     * @see https://github.com/basecamp/api/blob/master/sections/messages.md#list-messages
     */
    public function listMessages(int $projectId): array
    {
        return $this->request('GET', "/projects/{$projectId}/messages");
    }

    /**
     * Get a single message from a project.
     *
     * @param  int  $projectId   The Basecamp project ID.
     * @param  int  $messageId   The message (board post) ID.
     * @return array<string, mixed>
     *
     * @see https://github.com/basecamp/api/blob/master/sections/messages.md#get-a-message
     */
    public function getMessage(int $projectId, int $messageId): array
    {
        return $this->request('GET', "/projects/{$projectId}/messages/{$messageId}");
    }

    /**
     * Get the currently authenticated Basecamp user profile.
     *
     * @return array<string, mixed>
     *
     * @see https://github.com/basecamp/api/blob/master/sections/people.md#get-current-user
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path (e.g. "/projects").
     * @param  array<string, mixed>  $data  Request body / query params.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Basecamp 3 API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data  Request payload.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException  On missing credentials, connection failure, or API error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Basecamp access token is not configured.');
        }

        if (!$this->accountId) {
            throw new \RuntimeException('Basecamp account ID is not configured.');
        }

        $url = $this->apiBaseUrl() . $path;

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
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Basecamp API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Basecamp API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or your access token may be invalid.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Basecamp API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Basecamp API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Basecamp API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Basecamp API: {$e->getMessage()}");
        }
    }
}
