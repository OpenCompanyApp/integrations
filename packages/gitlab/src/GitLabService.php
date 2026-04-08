<?php

namespace OpenCompany\Integrations\GitLab;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the GitLab REST API (v4).
 *
 * Provides methods for projects, issues, merge requests, branches,
 * commits, files, groups, members, and labels.
 *
 * Supports both GitLab.com and self-hosted GitLab instances by
 * overriding the base URL.
 */
class GitLabService
{
    /**
     * Create a new GitLab API client.
     *
     * @param  string  $apiToken  GitLab Personal Access Token or OAuth token
     * @param  string  $baseUrl   GitLab API base URL (default: https://gitlab.com/api/v4)
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://gitlab.com/api/v4',
    ) {}

    /**
     * Check whether the GitLab API token has been configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiToken);
    }

    /*-----------------------------------------------------------------------
     | Connection
     *---------------------------------------------------------------------*/

    /**
     * Test the connection by fetching the authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /*-----------------------------------------------------------------------
     | Projects & Groups
     *---------------------------------------------------------------------*/

    /**
     * List projects visible to the authenticated user.
     *
     * @param  array<string, mixed>  $params  Query parameters (membership, search, page, per_page, etc.)
     * @return array<string, mixed>
     */
    public function listProjects(array $params = []): array
    {
        return $this->request('GET', '/projects', $params);
    }

    /**
     * Get details for a specific project.
     *
     * @param  int|string  $projectId  The ID or URL-encoded path of the project
     * @return array<string, mixed>
     */
    public function getProject(int|string $projectId): array
    {
        $id = urlencode((string) $projectId);

        return $this->request('GET', "/projects/{$id}");
    }

    /**
     * List groups visible to the authenticated user.
     *
     * @param  array<string, mixed>  $params  Query parameters (page, per_page, etc.)
     * @return array<string, mixed>
     */
    public function listGroups(array $params = []): array
    {
        return $this->request('GET', '/groups', $params);
    }

    /**
     * List members of a project.
     *
     * @param  int|string  $projectId  The ID or URL-encoded path of the project
     * @param  array<string, mixed>  $params  Query parameters (page, per_page, etc.)
     * @return array<string, mixed>
     */
    public function listProjectMembers(int|string $projectId, array $params = []): array
    {
        $id = urlencode((string) $projectId);

        return $this->request('GET', "/projects/{$id}/members", $params);
    }

    /**
     * List labels for a project.
     *
     * @param  int|string  $projectId  The ID or URL-encoded path of the project
     * @return array<string, mixed>
     */
    public function listLabels(int|string $projectId): array
    {
        $id = urlencode((string) $projectId);

        return $this->request('GET', "/projects/{$id}/labels");
    }

    /*-----------------------------------------------------------------------
     | Issues
     *---------------------------------------------------------------------*/

    /**
     * List issues in a project.
     *
     * @param  int|string  $projectId  The ID or URL-encoded path of the project
     * @param  array<string, mixed>  $params  Query parameters (state, labels, search, page, per_page, etc.)
     * @return array<string, mixed>
     */
    public function listIssues(int|string $projectId, array $params = []): array
    {
        $id = urlencode((string) $projectId);

        return $this->request('GET', "/projects/{$id}/issues", $params);
    }

    /**
     * Get details for a specific issue.
     *
     * @param  int|string  $projectId  The ID or URL-encoded path of the project
     * @param  int  $iid  The project-scoped issue IID
     * @return array<string, mixed>
     */
    public function getIssue(int|string $projectId, int $iid): array
    {
        $id = urlencode((string) $projectId);

        return $this->request('GET', "/projects/{$id}/issues/{$iid}");
    }

    /**
     * Create a new issue in a project.
     *
     * @param  int|string  $projectId  The ID or URL-encoded path of the project
     * @param  array<string, mixed>  $params  Issue properties (title, description, labels, assignee_ids, milestone_id, weight)
     * @return array<string, mixed>
     */
    public function createIssue(int|string $projectId, array $params): array
    {
        $id = urlencode((string) $projectId);

        return $this->request('POST', "/projects/{$id}/issues", $params);
    }

    /**
     * Update an existing issue.
     *
     * @param  int|string  $projectId  The ID or URL-encoded path of the project
     * @param  int  $iid  The project-scoped issue IID
     * @param  array<string, mixed>  $params  Issue properties to update (title, description, labels, state_event, assignee_ids)
     * @return array<string, mixed>
     */
    public function updateIssue(int|string $projectId, int $iid, array $params): array
    {
        $id = urlencode((string) $projectId);

        return $this->request('PUT', "/projects/{$id}/issues/{$iid}", $params);
    }

    /**
     * Create a comment (note) on an issue.
     *
     * @param  int|string  $projectId  The ID or URL-encoded path of the project
     * @param  int  $iid  The project-scoped issue IID
     * @param  string  $body  The comment body (supports GitLab Markdown)
     * @return array<string, mixed>
     */
    public function createIssueNote(int|string $projectId, int $iid, string $body): array
    {
        $id = urlencode((string) $projectId);

        return $this->request('POST', "/projects/{$id}/issues/{$iid}/notes", [
            'body' => $body,
        ]);
    }

    /*-----------------------------------------------------------------------
     | Merge Requests
     *---------------------------------------------------------------------*/

    /**
     * List merge requests in a project.
     *
     * @param  int|string  $projectId  The ID or URL-encoded path of the project
     * @param  array<string, mixed>  $params  Query parameters (state, page, per_page, etc.)
     * @return array<string, mixed>
     */
    public function listMergeRequests(int|string $projectId, array $params = []): array
    {
        $id = urlencode((string) $projectId);

        return $this->request('GET', "/projects/{$id}/merge_requests", $params);
    }

    /**
     * Get details for a specific merge request.
     *
     * @param  int|string  $projectId  The ID or URL-encoded path of the project
     * @param  int  $iid  The project-scoped merge request IID
     * @return array<string, mixed>
     */
    public function getMergeRequest(int|string $projectId, int $iid): array
    {
        $id = urlencode((string) $projectId);

        return $this->request('GET', "/projects/{$id}/merge_requests/{$iid}");
    }

    /**
     * Create a new merge request.
     *
     * @param  int|string  $projectId  The ID or URL-encoded path of the project
     * @param  array<string, mixed>  $params  MR properties (source_branch, target_branch, title, description, labels)
     * @return array<string, mixed>
     */
    public function createMergeRequest(int|string $projectId, array $params): array
    {
        $id = urlencode((string) $projectId);

        return $this->request('POST', "/projects/{$id}/merge_requests", $params);
    }

    /**
     * Update an existing merge request.
     *
     * @param  int|string  $projectId  The ID or URL-encoded path of the project
     * @param  int  $iid  The project-scoped merge request IID
     * @param  array<string, mixed>  $params  MR properties to update (title, description, state_event, labels)
     * @return array<string, mixed>
     */
    public function updateMergeRequest(int|string $projectId, int $iid, array $params): array
    {
        $id = urlencode((string) $projectId);

        return $this->request('PUT', "/projects/{$id}/merge_requests/{$iid}", $params);
    }

    /**
     * Accept (merge) a merge request.
     *
     * @param  int|string  $projectId  The ID or URL-encoded path of the project
     * @param  int  $iid  The project-scoped merge request IID
     * @param  array<string, mixed>  $params  Merge options (merge_commit_message, should_remove_source_branch, etc.)
     * @return array<string, mixed>
     */
    public function acceptMergeRequest(int|string $projectId, int $iid, array $params = []): array
    {
        $id = urlencode((string) $projectId);

        return $this->request('PUT', "/projects/{$id}/merge_requests/{$iid}/merge", $params);
    }

    /*-----------------------------------------------------------------------
     | Repository
     *---------------------------------------------------------------------*/

    /**
     * List branches in a project repository.
     *
     * @param  int|string  $projectId  The ID or URL-encoded path of the project
     * @param  array<string, mixed>  $params  Query parameters (search, page, per_page)
     * @return array<string, mixed>
     */
    public function listBranches(int|string $projectId, array $params = []): array
    {
        $id = urlencode((string) $projectId);

        return $this->request('GET', "/projects/{$id}/repository/branches", $params);
    }

    /**
     * Create a new branch in a project repository.
     *
     * @param  int|string  $projectId  The ID or URL-encoded path of the project
     * @param  string  $branch  The name of the new branch
     * @param  string  $ref  The branch name or commit SHA to create from
     * @return array<string, mixed>
     */
    public function createBranch(int|string $projectId, string $branch, string $ref): array
    {
        $id = urlencode((string) $projectId);

        return $this->request('POST', "/projects/{$id}/repository/branches", [
            'branch' => $branch,
            'ref' => $ref,
        ]);
    }

    /**
     * List commits in a project repository.
     *
     * @param  int|string  $projectId  The ID or URL-encoded path of the project
     * @param  array<string, mixed>  $params  Query parameters (ref_name, page, per_page, etc.)
     * @return array<string, mixed>
     */
    public function listCommits(int|string $projectId, array $params = []): array
    {
        $id = urlencode((string) $projectId);

        return $this->request('GET', "/projects/{$id}/repository/commits", $params);
    }

    /**
     * Get a file from the repository.
     *
     * @param  int|string  $projectId  The ID or URL-encoded path of the project
     * @param  string  $filePath  The URL-encoded file path
     * @param  string  $ref  The name of the branch, tag, or commit SHA
     * @return array<string, mixed>
     */
    public function getFile(int|string $projectId, string $filePath, string $ref): array
    {
        $id = urlencode((string) $projectId);
        $path = urlencode($filePath);

        return $this->request('GET', "/projects/{$id}/repository/files/{$path}", [
            'ref' => $ref,
        ]);
    }

    /*-----------------------------------------------------------------------
     | Core HTTP
     *---------------------------------------------------------------------*/

    /**
     * Make an authenticated API request to GitLab.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, PATCH, DELETE)
     * @param  string  $path  API endpoint path (e.g. /projects)
     * @param  array<string, mixed>  $params  Query or body parameters
     * @return array<string, mixed>
     *
     * @throws \RuntimeException
     */
    private function request(string $method, string $path, array $params = []): array
    {
        if (! $this->apiToken) {
            throw new \RuntimeException('GitLab API token is not configured.');
        }

        $params = array_filter($params, fn ($v) => $v !== null && $v !== '');

        try {
            $http = Http::withHeaders([
                'Authorization' => "Bearer {$this->apiToken}",
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $url = rtrim($this->baseUrl, '/') . $path;

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                'POST' => $http->post($url, $params),
                'PUT' => $http->put($url, $params),
                'PATCH' => $http->patch($url, $params),
                'DELETE' => $http->delete($url, $params),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->status() === 429) {
                throw new \RuntimeException('GitLab rate limit exceeded. Please try again later.');
            }

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['message'] ?? $body['error'] ?? $response->body();

                Log::error("GitLab API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException(
                    'GitLab API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error))
                );
            }

            // Some endpoints return 204 No Content
            if ($response->status() === 204 || $response->body() === '') {
                return ['success' => true];
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("GitLab API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to GitLab API: {$e->getMessage()}");
        }
    }
}
