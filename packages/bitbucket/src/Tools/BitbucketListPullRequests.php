<?php

namespace OpenCompany\Integrations\Bitbucket\Tools;

use OpenCompany\Integrations\Bitbucket\BitbucketService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List pull requests in a Bitbucket repository.
 */
class BitbucketListPullRequests implements Tool
{
    /**
     * @param  BitbucketService  $service  The Bitbucket API client
     */
    public function __construct(
        private BitbucketService $service,
    ) {}

    public function name(): string
    {
        return 'bitbucket_list_pull_requests';
    }

    public function description(): string
    {
        return 'List pull requests in a Bitbucket repository. Supports filtering by state and pagination.';
    }

    public function parameters(): array
    {
        return [
            'workspace' => ['type' => 'string', 'required' => true, 'description' => 'The workspace slug or UUID.'],
            'repo_slug' => ['type' => 'string', 'required' => true, 'description' => 'The repository slug.'],
            'state' => ['type' => 'string', 'description' => 'Filter by state: OPEN, MERGED, DECLINED, SUPERSEDED.'],
            'pagelen' => ['type' => 'integer', 'description' => 'Number of results per page (1-100). Default: 10.'],
        ];
    }

    /**
     * Retrieve pull requests for the given repository with optional state filter.
     *
     * @param  array<string, mixed>  $args  Tool arguments (workspace, repo_slug, state, pagelen)
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
                'state' => 'state',
                'pagelen' => 'pagelen',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->listPullRequests($workspace, $repoSlug, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
