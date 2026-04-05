<?php

namespace OpenCompany\Integrations\Bitbucket\Tools;

use OpenCompany\Integrations\Bitbucket\BitbucketService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Merge a Bitbucket pull request.
 */
class BitbucketMergePullRequest implements Tool
{
    /**
     * @param  BitbucketService  $service  The Bitbucket API client
     */
    public function __construct(
        private BitbucketService $service,
    ) {}

    public function name(): string
    {
        return 'bitbucket_merge_pull_request';
    }

    public function description(): string
    {
        return 'Merge a Bitbucket pull request. Optionally provide a merge commit message.';
    }

    public function parameters(): array
    {
        return [
            'workspace' => ['type' => 'string', 'required' => true, 'description' => 'The workspace slug or UUID.'],
            'repo_slug' => ['type' => 'string', 'required' => true, 'description' => 'The repository slug.'],
            'pr_id' => ['type' => 'integer', 'required' => true, 'description' => 'The pull request identifier.'],
            'merge_commit_message' => ['type' => 'string', 'description' => 'An optional message for the merge commit.'],
        ];
    }

    /**
     * Merge the specified pull request.
     *
     * @param  array<string, mixed>  $args  Tool arguments (workspace, repo_slug, pr_id, merge_commit_message)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Bitbucket is not configured. Missing API key.');
        }

        $workspace = $args['workspace'] ?? '';
        $repoSlug = $args['repo_slug'] ?? '';
        $prId = $args['pr_id'] ?? null;

        if (empty($workspace) || empty($repoSlug)) {
            return ToolResult::error('Both workspace and repo_slug are required.');
        }

        if ($prId === null) {
            return ToolResult::error('pr_id is required.');
        }

        try {
            $params = [];

            if (isset($args['merge_commit_message'])) {
                $params['message'] = $args['merge_commit_message'];
            }

            $result = $this->service->mergePullRequest($workspace, $repoSlug, (int) $prId, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
