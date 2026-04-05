<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new branch in a GitHub repository.
 */
class GitHubCreateBranch implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_create_branch';
    }

    public function description(): string
    {
        return 'Create a new branch in a GitHub repository. Requires a reference name (e.g. "refs/heads/my-feature") and the SHA of the commit to branch from.';
    }

    public function parameters(): array
    {
        return [
            'owner' => ['type' => 'string', 'required' => true, 'description' => 'The repository owner (user or organization).'],
            'repo' => ['type' => 'string', 'required' => true, 'description' => 'The name of the repository.'],
            'ref' => ['type' => 'string', 'required' => true, 'description' => 'The name of the fully qualified reference (e.g. "refs/heads/new-branch-name").'],
            'sha' => ['type' => 'string', 'required' => true, 'description' => 'The SHA1 value of the commit to start the branch from.'],
        ];
    }

    /**
     * Create a branch from a specific commit SHA.
     *
     * @param  array<string, mixed>  $args  Tool arguments (owner, repo, ref, sha)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitHub is not configured. Missing API key.');
        }

        $owner = $args['owner'] ?? '';
        $repo = $args['repo'] ?? '';
        $ref = $args['ref'] ?? '';
        $sha = $args['sha'] ?? '';

        if (empty($owner) || empty($repo)) {
            return ToolResult::error('Both owner and repo are required.');
        }

        if (empty($ref)) {
            return ToolResult::error('Reference name (ref) is required. Example: refs/heads/my-feature');
        }

        if (empty($sha)) {
            return ToolResult::error('Commit SHA is required.');
        }

        try {
            $params = [
                'ref' => $ref,
                'sha' => $sha,
            ];

            $result = $this->service->createBranch($owner, $repo, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
