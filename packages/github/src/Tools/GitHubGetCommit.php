<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a specific commit.
 */
class GitHubGetCommit implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_get_commit';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific commit, including author, committer, message, and file changes.';
    }

    public function parameters(): array
    {
        return [
            'owner' => ['type' => 'string', 'required' => true, 'description' => 'The repository owner (user or organization).'],
            'repo' => ['type' => 'string', 'required' => true, 'description' => 'The name of the repository.'],
            'ref' => ['type' => 'string', 'required' => true, 'description' => 'The commit SHA or branch name.'],
        ];
    }

    /**
     * Retrieve commit details including author, message, and file changes.
     *
     * @param  array<string, mixed>  $args  Tool arguments (owner, repo, ref)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitHub is not configured. Missing API key.');
        }

        $owner = $args['owner'] ?? '';
        $repo = $args['repo'] ?? '';
        $ref = $args['ref'] ?? '';

        if (empty($owner) || empty($repo)) {
            return ToolResult::error('Both owner and repo are required.');
        }

        if (empty($ref)) {
            return ToolResult::error('ref (commit SHA or branch name) is required.');
        }

        try {
            $result = $this->service->getCommit($owner, $repo, $ref);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
