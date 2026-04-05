<?php

namespace OpenCompany\Integrations\Jira;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Jira Cloud REST API.
 *
 * Provides methods for issues, projects, boards, sprints, users,
 * transitions, comments, attachments, versions, and priorities.
 */
class JiraService
{
    /**
     * @param  string  $apiToken  Jira Personal Access Token or OAuth token
     * @param  string  $baseUrl   Jira Cloud domain URL (e.g. https://mycompany.atlassian.net)
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://your-domain.atlassian.net',
    ) {}

    /**
     * Check whether the Jira API token has been configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiToken);
    }

    /*-----------------------------------------------------------------------
     | Issues
     *---------------------------------------------------------------------*/

    /**
     * Create a new issue.
     *
     * @param  array<string, mixed>  $fields  Issue fields (project.key, summary, issuetype.name, etc.)
     * @return array<string, mixed>
     */
    public function createIssue(array $fields): array
    {
        return $this->request('POST', '/rest/api/3/issue', ['fields' => $fields]);
    }

    /**
     * Get details for a specific issue.
     *
     * @return array<string, mixed>
     */
    public function getIssue(string $key): array
    {
        return $this->request('GET', "/rest/api/3/issue/{$key}");
    }

    /**
     * Update an existing issue.
     *
     * @param  array<string, mixed>  $fields  Issue fields to update
     * @return array<string, mixed>
     */
    public function updateIssue(string $key, array $fields): array
    {
        return $this->request('PUT', "/rest/api/3/issue/{$key}", ['fields' => $fields]);
    }

    /**
     * Search for issues using JQL (Jira Query Language).
     *
     * @param  array<string, mixed>  $params  Search parameters (jql, startAt, maxResults, fields)
     * @return array<string, mixed>
     */
    public function searchIssues(array $params): array
    {
        return $this->request('POST', '/rest/api/3/search', $params);
    }

    /**
     * Delete an issue.
     *
     * @return array<string, mixed>
     */
    public function deleteIssue(string $key): array
    {
        return $this->request('DELETE', "/rest/api/3/issue/{$key}");
    }

    /*-----------------------------------------------------------------------
     | Comments
     *---------------------------------------------------------------------*/

    /**
     * Add a comment to an issue.
     *
     * @return array<string, mixed>
     */
    public function addComment(string $issueKey, string $body): array
    {
        return $this->request('POST', "/rest/api/3/issue/{$issueKey}/comment", [
            'body' => [
                'type' => 'doc',
                'version' => 1,
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            ['type' => 'text', 'text' => $body],
                        ],
                    ],
                ],
            ],
        ]);
    }

    /**
     * List comments on an issue.
     *
     * @return array<string, mixed>
     */
    public function listComments(string $issueKey): array
    {
        return $this->request('GET', "/rest/api/3/issue/{$issueKey}/comment");
    }

    /*-----------------------------------------------------------------------
     | Transitions
     *---------------------------------------------------------------------*/

    /**
     * Get available transitions for an issue.
     *
     * @return array<string, mixed>
     */
    public function getTransitions(string $issueKey): array
    {
        return $this->request('GET', "/rest/api/3/issue/{$issueKey}/transitions");
    }

    /**
     * Transition (change status of) an issue.
     *
     * @return array<string, mixed>
     */
    public function transitionIssue(string $issueKey, string $transitionId): array
    {
        return $this->request('POST', "/rest/api/3/issue/{$issueKey}/transitions", [
            'transition' => ['id' => $transitionId],
        ]);
    }

    /*-----------------------------------------------------------------------
     | Assignee
     *---------------------------------------------------------------------*/

    /**
     * Assign an issue to a user by account ID.
     *
     * @return array<string, mixed>
     */
    public function assignIssue(string $issueKey, string $accountId): array
    {
        return $this->request('PUT', "/rest/api/3/issue/{$issueKey}/assignee", [
            'accountId' => $accountId,
        ]);
    }

    /*-----------------------------------------------------------------------
     | Attachments
     *---------------------------------------------------------------------*/

    /**
     * Add an attachment to an issue.
     *
     * Uses multipart/form-data with the X-Atlassian-Token: no-check header.
     *
     * @return array<string, mixed>
     */
    public function addAttachment(string $issueKey, string $filename, string $content): array
    {
        if (! $this->apiToken) {
            throw new \RuntimeException('Jira API token is not configured.');
        }

        $url = rtrim($this->baseUrl, '/') . "/rest/api/3/issue/{$issueKey}/attachments";

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$this->apiToken}",
                'X-Atlassian-Token' => 'no-check',
            ])->timeout(60)->attach('file', $content, $filename)->post($url);

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['errorMessages'][0] ?? $response->body();

                Log::error("Jira API error: POST /rest/api/3/issue/{$issueKey}/attachments", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException(
                    'Jira API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Jira API connection error: POST /rest/api/3/issue/{$issueKey}/attachments", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Jira API: {$e->getMessage()}");
        }
    }

    /*-----------------------------------------------------------------------
     | Projects & Metadata
     *---------------------------------------------------------------------*/

    /**
     * List projects accessible to the authenticated user.
     *
     * @param  array<string, mixed>  $params  Query parameters (startAt, maxResults)
     * @return array<string, mixed>
     */
    public function listProjects(array $params = []): array
    {
        return $this->request('GET', '/rest/api/3/project/search', $params);
    }

    /**
     * Get all issue types.
     *
     * @return array<string, mixed>
     */
    public function getIssueTypes(): array
    {
        return $this->request('GET', '/rest/api/3/issuetype');
    }

    /**
     * Get all priorities.
     *
     * @return array<string, mixed>
     */
    public function listPriorities(): array
    {
        return $this->request('GET', '/rest/api/3/priority');
    }

    /*-----------------------------------------------------------------------
     | Users
     *---------------------------------------------------------------------*/

    /**
     * Get details for a specific user by account ID.
     *
     * @return array<string, mixed>
     */
    public function getUser(string $accountId): array
    {
        return $this->request('GET', '/rest/api/3/user', ['accountId' => $accountId]);
    }

    /**
     * Search for users matching a query string.
     *
     * @param  array<string, mixed>  $params  Search parameters (query, maxResults)
     * @return array<string, mixed>
     */
    public function searchUsers(array $params): array
    {
        return $this->request('GET', '/rest/api/3/user/search', $params);
    }

    /*-----------------------------------------------------------------------
     | Versions
     *---------------------------------------------------------------------*/

    /**
     * Create a new version (release) in a project.
     *
     * @param  array<string, mixed>  $params  Version properties (project, name, description, startDate, releaseDate)
     * @return array<string, mixed>
     */
    public function createVersion(array $params): array
    {
        return $this->request('POST', '/rest/api/3/version', $params);
    }

    /*-----------------------------------------------------------------------
     | Boards & Sprints (Agile API)
     *---------------------------------------------------------------------*/

    /**
     * List boards accessible to the authenticated user.
     *
     * @param  array<string, mixed>  $params  Query parameters (startAt, maxResults)
     * @return array<string, mixed>
     */
    public function listBoards(array $params = []): array
    {
        return $this->agileRequest('GET', '/board', $params);
    }

    /**
     * List sprints for a specific board.
     *
     * @param  array<string, mixed>  $params  Query parameters (state)
     * @return array<string, mixed>
     */
    public function listSprints(int $boardId, array $params = []): array
    {
        return $this->agileRequest('GET', "/board/{$boardId}/sprint", $params);
    }

    /**
     * List issues in a specific sprint.
     *
     * @param  array<string, mixed>  $params  Query parameters (startAt, maxResults)
     * @return array<string, mixed>
     */
    public function listSprintIssues(int $sprintId, array $params = []): array
    {
        return $this->agileRequest('GET', "/sprint/{$sprintId}/issue", $params);
    }

    /*-----------------------------------------------------------------------
     | Connection Test
     *---------------------------------------------------------------------*/

    /**
     * Test the API connection by fetching the current user profile.
     *
     * @return array<string, mixed>
     */
    public function testConnection(): array
    {
        return $this->request('GET', '/rest/api/3/myself');
    }

    /*-----------------------------------------------------------------------
     | Core HTTP
     *---------------------------------------------------------------------*/

    /**
     * Make an authenticated API request to Jira REST API v3.
     *
     * @param  array<string, mixed>  $params  Query or body parameters
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $params = []): array
    {
        if (! $this->apiToken) {
            throw new \RuntimeException('Jira API token is not configured.');
        }

        $params = array_filter($params, fn ($v) => $v !== null && $v !== '');

        try {
            $http = Http::withHeaders([
                'Authorization' => "Bearer {$this->apiToken}",
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $url = rtrim($this->baseUrl, '/') . $path;

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                'POST' => $http->post($url, $params),
                'PUT' => $http->put($url, $params),
                'DELETE' => $http->delete($url, $params),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['errorMessages'][0] ?? $body['errors'] ?? $response->body();

                Log::error("Jira API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException(
                    'Jira API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error))
                );
            }

            if ($response->status() === 204 || $response->body() === '') {
                return ['success' => true];
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Jira API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Jira API: {$e->getMessage()}");
        }
    }

    /**
     * Make an authenticated API request to the Jira Agile API.
     *
     * @param  array<string, mixed>  $params  Query or body parameters
     * @return array<string, mixed>
     */
    private function agileRequest(string $method, string $path, array $params = []): array
    {
        if (! $this->apiToken) {
            throw new \RuntimeException('Jira API token is not configured.');
        }

        $params = array_filter($params, fn ($v) => $v !== null && $v !== '');

        try {
            $http = Http::withHeaders([
                'Authorization' => "Bearer {$this->apiToken}",
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $url = rtrim($this->baseUrl, '/') . '/rest/agile/1.0' . $path;

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                'POST' => $http->post($url, $params),
                'PUT' => $http->put($url, $params),
                'DELETE' => $http->delete($url, $params),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['errorMessages'][0] ?? $body['errors'] ?? $response->body();

                Log::error("Jira Agile API error: {$method} /rest/agile/1.0{$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException(
                    'Jira Agile API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error))
                );
            }

            if ($response->status() === 204 || $response->body() === '') {
                return ['success' => true];
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Jira Agile API connection error: {$method} /rest/agile/1.0{$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Jira Agile API: {$e->getMessage()}");
        }
    }
}
