<?php

namespace OpenCompany\Integrations\Bitbucket\Tools;

use OpenCompany\Integrations\Bitbucket\BitbucketService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List issues in a Bitbucket repository.
 */
class BitbucketListIssues implements Tool
{
    /**
     * @param  BitbucketService  $service  The Bitbucket API client
     */
    public function __construct(
        private BitbucketService $service,
    ) {}

    public function name(): string
    {
        return 'bitbucket_list_issues';
    }

    public function description(): string
    {
        return 'List issues in a Bitbucket repository. Supports filtering by state, kind, and priority.';
    }

    public function parameters(): array
    {
        return [
            'workspace' => ['type' => 'string', 'required' => true, 'description' => 'The workspace slug or UUID.'],
            'repo_slug' => ['type' => 'string', 'required' => true, 'description' => 'The repository slug.'],
            'state' => ['type' => 'string', 'description' => 'Filter by issue state: new, open, resolved, closed, on hold, wontfix, duplicate, invalid.'],
            'kind' => ['type' => 'string', 'description' => 'Filter by kind: bug, enhancement, proposal, task.'],
            'priority' => ['type' => 'string', 'description' => 'Filter by priority: trivial, minor, major, critical, blocker.'],
            'pagelen' => ['type' => 'integer', 'description' => 'Number of results per page (1-100). Default: 10.'],
        ];
    }

    /**
     * Retrieve issues for the given repository with optional filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (workspace, repo_slug, state, kind, priority, pagelen)
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
                'kind' => 'kind',
                'priority' => 'priority',
                'pagelen' => 'pagelen',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->listIssues($workspace, $repoSlug, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
