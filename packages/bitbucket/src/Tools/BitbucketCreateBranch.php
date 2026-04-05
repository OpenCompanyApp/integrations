<?php

namespace OpenCompany\Integrations\Bitbucket\Tools;

use OpenCompany\Integrations\Bitbucket\BitbucketService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new branch in a Bitbucket repository.
 */
class BitbucketCreateBranch implements Tool
{
    /**
     * @param  BitbucketService  $service  The Bitbucket API client
     */
    public function __construct(
        private BitbucketService $service,
    ) {}

    public function name(): string
    {
        return 'bitbucket_create_branch';
    }

    public function description(): string
    {
        return 'Create a new branch in a Bitbucket repository. Requires a branch name and the target commit hash.';
    }

    public function parameters(): array
    {
        return [
            'workspace' => ['type' => 'string', 'required' => true, 'description' => 'The workspace slug or UUID.'],
            'repo_slug' => ['type' => 'string', 'required' => true, 'description' => 'The repository slug.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name for the new branch.'],
            'target_hash' => ['type' => 'string', 'required' => true, 'description' => 'The commit hash to branch from.'],
        ];
    }

    /**
     * Create a branch from a specific commit hash.
     *
     * @param  array<string, mixed>  $args  Tool arguments (workspace, repo_slug, name, target_hash)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Bitbucket is not configured. Missing API key.');
        }

        $workspace = $args['workspace'] ?? '';
        $repoSlug = $args['repo_slug'] ?? '';
        $name = $args['name'] ?? '';
        $targetHash = $args['target_hash'] ?? '';

        if (empty($workspace) || empty($repoSlug)) {
            return ToolResult::error('Both workspace and repo_slug are required.');
        }

        if (empty($name)) {
            return ToolResult::error('Branch name is required.');
        }

        if (empty($targetHash)) {
            return ToolResult::error('Target commit hash is required.');
        }

        try {
            $result = $this->service->createBranch($workspace, $repoSlug, $name, $targetHash);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
