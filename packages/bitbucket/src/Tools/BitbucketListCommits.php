<?php

namespace OpenCompany\Integrations\Bitbucket\Tools;

use OpenCompany\Integrations\Bitbucket\BitbucketService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List commits in a Bitbucket repository.
 */
class BitbucketListCommits implements Tool
{
    /**
     * @param  BitbucketService  $service  The Bitbucket API client
     */
    public function __construct(
        private BitbucketService $service,
    ) {}

    public function name(): string
    {
        return 'bitbucket_list_commits';
    }

    public function description(): string
    {
        return 'List commits in a Bitbucket repository. Supports filtering by revision and path.';
    }

    public function parameters(): array
    {
        return [
            'workspace' => ['type' => 'string', 'required' => true, 'description' => 'The workspace slug or UUID.'],
            'repo_slug' => ['type' => 'string', 'required' => true, 'description' => 'The repository slug.'],
            'revision' => ['type' => 'string', 'description' => 'A commit hash, branch name, or tag to list commits for.'],
            'path' => ['type' => 'string', 'description' => 'Filter commits to those affecting a specific file path.'],
            'pagelen' => ['type' => 'integer', 'description' => 'Number of results per page (1-100). Default: 10.'],
        ];
    }

    /**
     * Retrieve commits for the given repository with optional revision and path filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (workspace, repo_slug, revision, path, pagelen)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Bitbucket is not configured. Missing API key.');
        }

        $workspace = $args['workspace'] ?? '';
        $repoSlug = $args['repo_slug'] ?? '';

        if (empty($workspace) || empty($repoSlug)) {
            return ToolResult::error('Both workspace and repo_slug are required.');
        }

        try {
            $params = [];

            $mapping = [
                'revision' => 'revision',
                'path' => 'path',
                'pagelen' => 'pagelen',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->listCommits($workspace, $repoSlug, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
