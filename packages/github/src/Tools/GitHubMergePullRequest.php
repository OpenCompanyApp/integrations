<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Merge a GitHub pull request.
 */
class GitHubMergePullRequest implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_merge_pull_request';
    }

    public function description(): string
    {
        return 'Merge a GitHub pull request. Supports merge commit, squash, or rebase merge methods.';
    }

    public function parameters(): array
    {
        return [
            'owner' => ['type' => 'string', 'required' => true, 'description' => 'The repository owner (user or organization).'],
            'repo' => ['type' => 'string', 'required' => true, 'description' => 'The name of the repository.'],
            'pull_number' => ['type' => 'integer', 'required' => true, 'description' => 'The pull request number to merge.'],
            'commit_title' => ['type' => 'string', 'description' => 'Title for the automatic commit message.'],
            'commit_message' => ['type' => 'string', 'description' => 'Extra detail for the automatic commit message.'],
            'merge_method' => ['type' => 'string', 'description' => 'Merge method: merge, squash, or rebase. Default: merge.'],
        ];
    }

    /**
     * Merge a pull request using merge commit, squash, or rebase.
     *
     * @param  array<string, mixed>  $args  Tool arguments (owner, repo, pull_number, commit_title, commit_message, merge_method)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitHub is not configured. Missing API key.');
        }

        $owner = $args['owner'] ?? '';
        $repo = $args['repo'] ?? '';
        $pullNumber = $args['pull_number'] ?? null;

        if (empty($owner) || empty($repo)) {
            return ToolResult::error('Both owner and repo are required.');
        }

        if ($pullNumber === null) {
            return ToolResult::error('pull_number is required.');
        }

        try {
            $params = [];

            $mapping = [
                'commit_title' => 'commit_title',
                'commit_message' => 'commit_message',
                'merge_method' => 'merge_method',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->mergePullRequest($owner, $repo, (int) $pullNumber, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
