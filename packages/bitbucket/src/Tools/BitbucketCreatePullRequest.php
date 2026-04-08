<?php

namespace OpenCompany\Integrations\Bitbucket\Tools;

use OpenCompany\Integrations\Bitbucket\BitbucketService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new pull request in a Bitbucket repository.
 */
class BitbucketCreatePullRequest implements Tool
{
    /**
     * @param  BitbucketService  $service  The Bitbucket API client
     */
    public function __construct(
        private BitbucketService $service,
    ) {}

    public function name(): string
    {
        return 'bitbucket_create_pull_request';
    }

    public function description(): string
    {
        return 'Create a new pull request in a Bitbucket repository. Requires a title, source branch, and destination branch.';
    }

    public function parameters(): array
    {
        return [
            'workspace' => ['type' => 'string', 'required' => true, 'description' => 'The workspace slug or UUID.'],
            'repo_slug' => ['type' => 'string', 'required' => true, 'description' => 'The repository slug.'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title of the pull request.'],
            'description' => ['type' => 'string', 'description' => 'The pull request description (Markdown supported).'],
            'source_branch' => ['type' => 'string', 'required' => true, 'description' => 'The name of the source branch.'],
            'destination_branch' => ['type' => 'string', 'description' => 'The name of the destination branch. Default: main.'],
            'close_source_branch' => ['type' => 'boolean', 'description' => 'Whether to close the source branch after merge. Default: false.'],
        ];
    }

    /**
     * Create a pull request from source to destination branch.
     *
     * @param  array<string, mixed>  $args  Tool arguments (workspace, repo_slug, title, description, source_branch, destination_branch, close_source_branch)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Bitbucket is not configured. Missing API key.');
        }

        $workspace = $args['workspace'] ?? '';
        $repoSlug = $args['repo_slug'] ?? '';
        $title = $args['title'] ?? '';
        $sourceBranch = $args['source_branch'] ?? '';

        if (empty($workspace) || empty($repoSlug)) {
            return ToolResult::error('Both workspace and repo_slug are required.');
        }

        if (empty($title)) {
            return ToolResult::error('Pull request title is required.');
        }

        if (empty($sourceBranch)) {
            return ToolResult::error('source_branch is required.');
        }

        try {
            $params = [
                'title' => $title,
                'source_branch' => $sourceBranch,
            ];

            $mapping = [
                'description' => 'description',
                'destination_branch' => 'destination_branch',
                'close_source_branch' => 'close_source_branch',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->createPullRequest($workspace, $repoSlug, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
