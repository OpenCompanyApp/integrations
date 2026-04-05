<?php

namespace OpenCompany\Integrations\GitHub;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the GitHub REST API.
 *
 * Provides methods for repositories, issues, pull requests, commits,
 * branches, releases, gists, and GitHub Actions workflows.
 */
class GitHubService
{
    private const BASE_URL = 'https://api.github.com';

    /**
     * @param  string  $apiKey  GitHub Personal Access Token
     */
    public function __construct(
        private string $apiKey = '',
    ) {}

    /**
     * Check whether the GitHub API key has been configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    /*-----------------------------------------------------------------------
     | Repositories
     *---------------------------------------------------------------------*/

    /**
     * List repositories for the authenticated user.
     *
     * @param  array<string, mixed>  $params  Query parameters (type, sort, direction, per_page, page)
     * @return array<string, mixed>
     */
    public function listRepos(array $params = []): array
    {
        return $this->request('GET', '/user/repos', $params);
    }

    /**
     * Get details for a specific repository.
     *
     * @return array<string, mixed>
     */
    public function getRepo(string $owner, string $repo): array
    {
        return $this->request('GET', "/repos/{$owner}/{$repo}");
    }

    /**
     * Create a new repository for the authenticated user.
     *
     * @param  array<string, mixed>  $params  Repository properties (name, description, private, auto_init)
     * @return array<string, mixed>
     */
    public function createRepo(array $params): array
    {
        return $this->request('POST', '/user/repos', $params);
    }

    /**
     * Search for repositories on GitHub.
     *
     * @param  array<string, mixed>  $params  Search parameters (q, sort, order, per_page)
     * @return array<string, mixed>
     */
    public function searchRepos(array $params): array
    {
        return $this->request('GET', '/search/repositories', $params);
    }

    /*-----------------------------------------------------------------------
     | Issues
     *---------------------------------------------------------------------*/

    /**
     * List issues in a repository.
     *
     * @param  array<string, mixed>  $params  Query parameters (state, labels, sort, direction, per_page)
     * @return array<string, mixed>
     */
    public function listIssues(string $owner, string $repo, array $params = []): array
    {
        return $this->request('GET', "/repos/{$owner}/{$repo}/issues", $params);
    }

    /**
     * Get details for a specific issue.
     *
     * @return array<string, mixed>
     */
    public function getIssue(string $owner, string $repo, int $number): array
    {
        return $this->request('GET', "/repos/{$owner}/{$repo}/issues/{$number}");
    }

    /**
     * Create a new issue in a repository.
     *
     * @param  array<string, mixed>  $params  Issue properties (title, body, assignees, labels, milestone)
     * @return array<string, mixed>
     */
    public function createIssue(string $owner, string $repo, array $params): array
    {
        return $this->request('POST', "/repos/{$owner}/{$repo}/issues", $params);
    }

    /**
     * Update an existing issue.
     *
     * @param  array<string, mixed>  $params  Issue properties to update (title, body, state, assignees, labels, milestone)
     * @return array<string, mixed>
     */
    public function updateIssue(string $owner, string $repo, int $number, array $params): array
    {
        return $this->request('PATCH', "/repos/{$owner}/{$repo}/issues/{$number}", $params);
    }

    /**
     * Add labels to an issue.
     *
     * @param  string[]  $labels  Label names to add
     * @return array<string, mixed>
     */
    public function addLabels(string $owner, string $repo, int $number, array $labels): array
    {
        return $this->request('POST', "/repos/{$owner}/{$repo}/issues/{$number}/labels", [
            'labels' => $labels,
        ]);
    }

    /**
     * Add a comment to an issue or pull request.
     *
     * @return array<string, mixed>
     */
    public function createIssueComment(string $owner, string $repo, int $number, string $body): array
    {
        return $this->request('POST', "/repos/{$owner}/{$repo}/issues/{$number}/comments", [
            'body' => $body,
        ]);
    }

    /*-----------------------------------------------------------------------
     | Pull Requests
     *---------------------------------------------------------------------*/

    /**
     * List pull requests in a repository.
     *
     * @param  array<string, mixed>  $params  Query parameters (state, sort, direction, per_page)
     * @return array<string, mixed>
     */
    public function listPullRequests(string $owner, string $repo, array $params = []): array
    {
        return $this->request('GET', "/repos/{$owner}/{$repo}/pulls", $params);
    }

    /**
     * Get details for a specific pull request.
     *
     * @return array<string, mixed>
     */
    public function getPullRequest(string $owner, string $repo, int $number): array
    {
        return $this->request('GET', "/repos/{$owner}/{$repo}/pulls/{$number}");
    }

    /**
     * Create a new pull request.
     *
     * @param  array<string, mixed>  $params  Pull request properties (title, body, head, base, draft)
     * @return array<string, mixed>
     */
    public function createPullRequest(string $owner, string $repo, array $params): array
    {
        return $this->request('POST', "/repos/{$owner}/{$repo}/pulls", $params);
    }

    /**
     * Update an existing pull request.
     *
     * @param  array<string, mixed>  $params  Properties to update (title, body, state, base)
     * @return array<string, mixed>
     */
    public function updatePullRequest(string $owner, string $repo, int $number, array $params): array
    {
        return $this->request('PATCH', "/repos/{$owner}/{$repo}/pulls/{$number}", $params);
    }

    /**
     * Merge a pull request.
     *
     * @param  array<string, mixed>  $params  Merge options (commit_title, commit_message, merge_method)
     * @return array<string, mixed>
     */
    public function mergePullRequest(string $owner, string $repo, int $number, array $params = []): array
    {
        return $this->request('PUT', "/repos/{$owner}/{$repo}/pulls/{$number}/merge", $params);
    }

    /**
     * List reviews on a pull request.
     *
     * @return array<string, mixed>
     */
    public function listPullRequestReviews(string $owner, string $repo, int $number): array
    {
        return $this->request('GET', "/repos/{$owner}/{$repo}/pulls/{$number}/reviews");
    }

    /**
     * Create a review on a pull request.
     *
     * @param  array<string, mixed>  $params  Review properties (body, event, comments)
     * @return array<string, mixed>
     */
    public function createReview(string $owner, string $repo, int $number, array $params): array
    {
        return $this->request('POST', "/repos/{$owner}/{$repo}/pulls/{$number}/reviews", $params);
    }

    /*-----------------------------------------------------------------------
     | Commits & Content
     *---------------------------------------------------------------------*/

    /**
     * List commits in a repository.
     *
     * @param  array<string, mixed>  $params  Query parameters (sha, path, author, per_page)
     * @return array<string, mixed>
     */
    public function listCommits(string $owner, string $repo, array $params = []): array
    {
        return $this->request('GET', "/repos/{$owner}/{$repo}/commits", $params);
    }

    /**
     * Get details for a specific commit.
     *
     * @return array<string, mixed>
     */
    public function getCommit(string $owner, string $repo, string $ref): array
    {
        return $this->request('GET', "/repos/{$owner}/{$repo}/commits/{$ref}");
    }

    /**
     * Get the content of a file or directory in a repository.
     *
     * @param  array<string, mixed>  $params  Query parameters (ref)
     * @return array<string, mixed>
     */
    public function getFileContent(string $owner, string $repo, string $path, array $params = []): array
    {
        return $this->request('GET', "/repos/{$owner}/{$repo}/contents/{$path}", $params);
    }

    /**
     * Create or update a file in a repository.
     *
     * @param  array<string, mixed>  $params  File properties (message, content, sha, branch)
     * @return array<string, mixed>
     */
    public function createOrUpdateFile(string $owner, string $repo, string $path, array $params): array
    {
        return $this->request('PUT', "/repos/{$owner}/{$repo}/contents/{$path}", $params);
    }

    /*-----------------------------------------------------------------------
     | Branches
     *---------------------------------------------------------------------*/

    /**
     * Create a new branch (Git reference).
     *
     * @param  array<string, mixed>  $params  Reference properties (ref, sha)
     * @return array<string, mixed>
     */
    public function createBranch(string $owner, string $repo, array $params): array
    {
        return $this->request('POST', "/repos/{$owner}/{$repo}/git/refs", $params);
    }

    /**
     * List branches in a repository.
     *
     * @param  array<string, mixed>  $params  Query parameters (per_page)
     * @return array<string, mixed>
     */
    public function listBranches(string $owner, string $repo, array $params = []): array
    {
        return $this->request('GET', "/repos/{$owner}/{$repo}/branches", $params);
    }

    /*-----------------------------------------------------------------------
     | Releases
     *---------------------------------------------------------------------*/

    /**
     * List releases in a repository.
     *
     * @return array<string, mixed>
     */
    public function listReleases(string $owner, string $repo): array
    {
        return $this->request('GET', "/repos/{$owner}/{$repo}/releases");
    }

    /**
     * Create a new release in a repository.
     *
     * @param  array<string, mixed>  $params  Release properties (tag_name, target_commitish, name, body, draft, prerelease)
     * @return array<string, mixed>
     */
    public function createRelease(string $owner, string $repo, array $params): array
    {
        return $this->request('POST', "/repos/{$owner}/{$repo}/releases", $params);
    }

    /*-----------------------------------------------------------------------
     | Search & Misc
     *---------------------------------------------------------------------*/

    /**
     * Search for issues and pull requests across GitHub.
     *
     * @param  array<string, mixed>  $params  Search parameters (q, sort, order, per_page)
     * @return array<string, mixed>
     */
    public function searchIssues(array $params): array
    {
        return $this->request('GET', '/search/issues', $params);
    }

    /**
     * Get the authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Create a new gist.
     *
     * @param  array<string, mixed>  $params  Gist properties (description, files, public)
     * @return array<string, mixed>
     */
    public function createGist(array $params): array
    {
        return $this->request('POST', '/gists', $params);
    }

    /*-----------------------------------------------------------------------
     | Actions / Workflows
     *---------------------------------------------------------------------*/

    /**
     * List GitHub Actions workflow runs for a repository.
     *
     * @param  array<string, mixed>  $params  Query parameters (status, per_page)
     * @return array<string, mixed>
     */
    public function listWorkflowRuns(string $owner, string $repo, array $params = []): array
    {
        return $this->request('GET', "/repos/{$owner}/{$repo}/actions/runs", $params);
    }

    /**
     * Trigger a GitHub Actions workflow dispatch event.
     *
     * @param  array<string, mixed>  $params  Dispatch parameters (ref, inputs)
     * @return array<string, mixed>
     */
    public function dispatchWorkflow(string $owner, string $repo, string $workflowId, array $params): array
    {
        return $this->request('POST', "/repos/{$owner}/{$repo}/actions/workflows/{$workflowId}/dispatches", $params);
    }

    /*-----------------------------------------------------------------------
     | Core HTTP
     *---------------------------------------------------------------------*/

    /**
     * Make an authenticated API request to GitHub.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $params = []): array
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('GitHub API key is not configured.');
        }

        $params = array_filter($params, fn ($v) => $v !== null && $v !== '');

        try {
            $http = Http::withHeaders([
                'Authorization' => "Bearer {$this->apiKey}",
                'Accept' => 'application/vnd.github+json',
                'X-GitHub-Api-Version' => '2022-11-28',
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
                $reset = $response->header('X-RateLimit-Reset');
                $msg = 'GitHub rate limit exceeded.';
                if ($reset) {
                    $msg .= " Resets at: {$reset}";
                }
                throw new \RuntimeException($msg);
            }

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['message'] ?? $response->body();

                Log::error("GitHub API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException(
                    'GitHub API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error))
                );
            }

            // Some endpoints return 204 No Content (e.g. workflow dispatch)
            if ($response->status() === 204 || $response->body() === '') {
                return ['success' => true];
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("GitHub API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to GitHub API: {$e->getMessage()}");
        }
    }
}
