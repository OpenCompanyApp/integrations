<?php

namespace OpenCompany\Integrations\Bitbucket;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Bitbucket REST API (v2).
 *
 * Provides methods for repositories, issues, pull requests, branches,
 * commits, and file contents via the Bitbucket Cloud API.
 */
class BitbucketService
{
    private const BASE_URL = 'https://api.bitbucket.org/2.0';

    /**
     * @param  string  $apiKey  Bitbucket app password or OAuth token
     */
    public function __construct(
        private string $apiKey = '',
    ) {}

    /**
     * Check whether the Bitbucket API key has been configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    /*-----------------------------------------------------------------------
     | Repositories
     *---------------------------------------------------------------------*/

    /**
     * List repositories in a workspace.
     *
     * @param  string  $workspace  The workspace slug or UUID
     * @param  array<string, mixed>  $params  Query parameters (sort, pagelen, page)
     * @return array<string, mixed>
     */
    public function listRepos(string $workspace, array $params = []): array
    {
        return $this->request('GET', "/repositories/{$workspace}", $params);
    }

    /**
     * Get details for a specific repository.
     *
     * @param  string  $workspace  The workspace slug or UUID
     * @param  string  $repoSlug   The repository slug
     * @return array<string, mixed>
     */
    public function getRepo(string $workspace, string $repoSlug): array
    {
        return $this->request('GET', "/repositories/{$workspace}/{$repoSlug}");
    }

    /**
     * Create a new repository in a workspace.
     *
     * @param  string  $workspace  The workspace slug or UUID
     * @param  string  $repoSlug   The repository slug for the new repo
     * @param  array<string, mixed>  $params  Repository properties (description, is_private, language)
     * @return array<string, mixed>
     */
    public function createRepo(string $workspace, string $repoSlug, array $params = []): array
    {
        return $this->request('POST', "/repositories/{$workspace}/{$repoSlug}", $params);
    }

    /*-----------------------------------------------------------------------
     | Issues
     *---------------------------------------------------------------------*/

    /**
     * List issues in a repository.
     *
     * @param  string  $workspace  The workspace slug or UUID
     * @param  string  $repoSlug   The repository slug
     * @param  array<string, mixed>  $params  Query parameters (state, kind, priority, pagelen)
     * @return array<string, mixed>
     */
    public function listIssues(string $workspace, string $repoSlug, array $params = []): array
    {
        return $this->request('GET', "/repositories/{$workspace}/{$repoSlug}/issues", $params);
    }

    /**
     * Get details for a specific issue.
     *
     * @param  string  $workspace  The workspace slug or UUID
     * @param  string  $repoSlug   The repository slug
     * @param  int  $issueId       The issue identifier
     * @return array<string, mixed>
     */
    public function getIssue(string $workspace, string $repoSlug, int $issueId): array
    {
        return $this->request('GET', "/repositories/{$workspace}/{$repoSlug}/issues/{$issueId}");
    }

    /**
     * Create a new issue in a repository.
     *
     * @param  string  $workspace  The workspace slug or UUID
     * @param  string  $repoSlug   The repository slug
     * @param  array<string, mixed>  $params  Issue properties (title, content, kind, priority, assignee)
     * @return array<string, mixed>
     */
    public function createIssue(string $workspace, string $repoSlug, array $params): array
    {
        return $this->request('POST', "/repositories/{$workspace}/{$repoSlug}/issues", $params);
    }

    /**
     * Update an existing issue.
     *
     * @param  string  $workspace  The workspace slug or UUID
     * @param  string  $repoSlug   The repository slug
     * @param  int  $issueId       The issue identifier
     * @param  array<string, mixed>  $params  Issue properties to update (title, content, state, priority, assignee)
     * @return array<string, mixed>
     */
    public function updateIssue(string $workspace, string $repoSlug, int $issueId, array $params): array
    {
        return $this->request('PUT', "/repositories/{$workspace}/{$repoSlug}/issues/{$issueId}", $params);
    }

    /*-----------------------------------------------------------------------
     | Pull Requests
     *---------------------------------------------------------------------*/

    /**
     * List pull requests in a repository.
     *
     * @param  string  $workspace  The workspace slug or UUID
     * @param  string  $repoSlug   The repository slug
     * @param  array<string, mixed>  $params  Query parameters (state, pagelen)
     * @return array<string, mixed>
     */
    public function listPullRequests(string $workspace, string $repoSlug, array $params = []): array
    {
        return $this->request('GET', "/repositories/{$workspace}/{$repoSlug}/pullrequests", $params);
    }

    /**
     * Get details for a specific pull request.
     *
     * @param  string  $workspace  The workspace slug or UUID
     * @param  string  $repoSlug   The repository slug
     * @param  int  $prId          The pull request identifier
     * @return array<string, mixed>
     */
    public function getPullRequest(string $workspace, string $repoSlug, int $prId): array
    {
        return $this->request('GET', "/repositories/{$workspace}/{$repoSlug}/pullrequests/{$prId}");
    }

    /**
     * Create a new pull request.
     *
     * @param  string  $workspace  The workspace slug or UUID
     * @param  string  $repoSlug   The repository slug
     * @param  array<string, mixed>  $params  Pull request properties (title, description, source_branch, destination_branch, close_source_branch)
     * @return array<string, mixed>
     */
    public function createPullRequest(string $workspace, string $repoSlug, array $params): array
    {
        $body = [
            'title' => $params['title'] ?? '',
            'description' => $params['description'] ?? '',
            'source' => [
                'branch' => [
                    'name' => $params['source_branch'] ?? '',
                ],
            ],
            'destination' => [
                'branch' => [
                    'name' => $params['destination_branch'] ?? 'main',
                ],
            ],
            'close_source_branch' => $params['close_source_branch'] ?? false,
        ];

        return $this->request('POST', "/repositories/{$workspace}/{$repoSlug}/pullrequests", $body);
    }

    /**
     * Merge a pull request.
     *
     * @param  string  $workspace  The workspace slug or UUID
     * @param  string  $repoSlug   The repository slug
     * @param  int  $prId          The pull request identifier
     * @param  array<string, mixed>  $params  Merge options (merge_commit_message)
     * @return array<string, mixed>
     */
    public function mergePullRequest(string $workspace, string $repoSlug, int $prId, array $params = []): array
    {
        return $this->request('POST', "/repositories/{$workspace}/{$repoSlug}/pullrequests/{$prId}/merge", $params);
    }

    /*-----------------------------------------------------------------------
     | Branches
     *---------------------------------------------------------------------*/

    /**
     * List branches in a repository.
     *
     * @param  string  $workspace  The workspace slug or UUID
     * @param  string  $repoSlug   The repository slug
     * @param  array<string, mixed>  $params  Query parameters (pagelen)
     * @return array<string, mixed>
     */
    public function listBranches(string $workspace, string $repoSlug, array $params = []): array
    {
        return $this->request('GET', "/repositories/{$workspace}/{$repoSlug}/refs/branches", $params);
    }

    /**
     * Create a new branch in a repository.
     *
     * @param  string  $workspace   The workspace slug or UUID
     * @param  string  $repoSlug    The repository slug
     * @param  string  $name        The new branch name
     * @param  string  $targetHash  The commit hash to branch from
     * @return array<string, mixed>
     */
    public function createBranch(string $workspace, string $repoSlug, string $name, string $targetHash): array
    {
        $body = [
            'name' => $name,
            'target' => [
                'hash' => $targetHash,
            ],
        ];

        return $this->request('POST', "/repositories/{$workspace}/{$repoSlug}/refs/branches", $body);
    }

    /*-----------------------------------------------------------------------
     | Commits & Content
     *---------------------------------------------------------------------*/

    /**
     * List commits in a repository.
     *
     * @param  string  $workspace  The workspace slug or UUID
     * @param  string  $repoSlug   The repository slug
     * @param  array<string, mixed>  $params  Query parameters (revision, path, pagelen)
     * @return array<string, mixed>
     */
    public function listCommits(string $workspace, string $repoSlug, array $params = []): array
    {
        return $this->request('GET', "/repositories/{$workspace}/{$repoSlug}/commits", $params);
    }

    /**
     * Get the raw content of a file in a repository.
     *
     * @param  string  $workspace  The workspace slug or UUID
     * @param  string  $repoSlug   The repository slug
     * @param  string  $revision   The commit, branch, or tag reference
     * @param  string  $filePath   The path to the file
     * @return array<string, mixed>
     */
    public function getFile(string $workspace, string $repoSlug, string $revision, string $filePath): array
    {
        return $this->request('GET', "/repositories/{$workspace}/{$repoSlug}/src/{$revision}/{$filePath}");
    }

    /*-----------------------------------------------------------------------
     | User
     *---------------------------------------------------------------------*/

    /**
     * Get the authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /*-----------------------------------------------------------------------
     | Core HTTP
     *---------------------------------------------------------------------*/

    /**
     * Make an authenticated API request to Bitbucket.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, PATCH, DELETE)
     * @param  string  $path    API path (relative to base URL)
     * @param  array<string, mixed>  $params  Query or body parameters
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $params = []): array
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('Bitbucket API key is not configured.');
        }

        $params = array_filter($params, fn ($v) => $v !== null && $v !== '');

        try {
            $http = Http::withHeaders([
                'Authorization' => "Bearer {$this->apiKey}",
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $url = self::BASE_URL . $path;

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                'POST' => $http->post($url, $params),
                'PUT' => $http->put($url, $params),
                'PATCH' => $http->patch($url, $params),
                'DELETE' => $http->delete($url, $params),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->status() === 429) {
                throw new \RuntimeException('Bitbucket rate limit exceeded. Please retry later.');
            }

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['error']['message'] ?? $response->body();

                Log::error("Bitbucket API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException(
                    'Bitbucket API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error))
                );
            }

            // Some endpoints return 204 No Content
            if ($response->status() === 204 || $response->body() === '') {
                return ['success' => true];
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Bitbucket API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Bitbucket API: {$e->getMessage()}");
        }
    }
}
