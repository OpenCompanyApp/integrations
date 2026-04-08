<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a specific GitHub pull request.
 */
class GitHubGetPullRequest implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_get_pull_request';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific GitHub pull request, including title, body, branch info, merge status, and review status.';
    }

    public function parameters(): array
    {
        return [
            'owner' => ['type' => 'string', 'required' => true, 'description' => 'The repository owner (user or organization).'],
            'repo' => ['type' => 'string', 'required' => true, 'description' => 'The name of the repository.'],
            'pull_number' => ['type' => 'integer', 'required' => true, 'description' => 'The pull request number.'],
        ];
    }

    /**
     * Retrieve pull request details including branch info and merge status.
     *
     * @param  array<string, mixed>  $args  Tool arguments (owner, repo, pull_number)
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
            $result = $this->service->getPullRequest($owner, $repo, (int) $pullNumber);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
