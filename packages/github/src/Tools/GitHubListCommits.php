<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List commits in a GitHub repository.
 */
class GitHubListCommits implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_list_commits';
    }

    public function description(): string
    {
        return 'List commits in a GitHub repository. Supports filtering by branch (SHA), file path, and author.';
    }

    public function parameters(): array
    {
        return [
            'owner' => ['type' => 'string', 'required' => true, 'description' => 'The repository owner (user or organization).'],
            'repo' => ['type' => 'string', 'required' => true, 'description' => 'The name of the repository.'],
            'sha' => ['type' => 'string', 'description' => 'Branch name or SHA to filter commits by.'],
            'path' => ['type' => 'string', 'description' => 'File path to filter commits by. Only commits containing this file path will be returned.'],
            'author' => ['type' => 'string', 'description' => 'GitHub username or email address to filter by author.'],
            'per_page' => ['type' => 'integer', 'description' => 'Results per page (1-100). Default: 30.'],
        ];
    }

    /**
     * Retrieve commits with optional filtering by branch, path, or author.
     *
     * @param  array<string, mixed>  $args  Tool arguments (owner, repo, sha, path, author, per_page)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitHub is not configured. Missing API key.');
        }

        $owner = $args['owner'] ?? '';
        $repo = $args['repo'] ?? '';

        if (empty($owner) || empty($repo)) {
            return ToolResult::error('Both owner and repo are required.');
        }

        try {
            $params = [];

            $mapping = [
                'sha' => 'sha',
                'path' => 'path',
                'author' => 'author',
                'per_page' => 'per_page',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->listCommits($owner, $repo, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
