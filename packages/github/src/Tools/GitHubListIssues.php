<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List issues in a GitHub repository.
 */
class GitHubListIssues implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_list_issues';
    }

    public function description(): string
    {
        return 'List issues in a GitHub repository. Supports filtering by state (open, closed, all), labels, and sorting.';
    }

    public function parameters(): array
    {
        return [
            'owner' => ['type' => 'string', 'required' => true, 'description' => 'The repository owner (user or organization).'],
            'repo' => ['type' => 'string', 'required' => true, 'description' => 'The name of the repository.'],
            'state' => ['type' => 'string', 'description' => 'Issue state filter: open, closed, all. Default: open.'],
            'labels' => ['type' => 'string', 'description' => 'Comma-separated list of label names to filter by. Example: "bug,urgent".'],
            'sort' => ['type' => 'string', 'description' => 'Sort field: created, updated, comments. Default: created.'],
            'direction' => ['type' => 'string', 'description' => 'Sort direction: asc or desc. Default: desc.'],
            'per_page' => ['type' => 'integer', 'description' => 'Results per page (1-100). Default: 30.'],
        ];
    }

    /**
     * Retrieve issues with optional filtering by state, labels, and sort order.
     *
     * @param  array<string, mixed>  $args  Tool arguments (owner, repo, state, labels, sort, direction, per_page)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitHub is not configured. Missing API key.');
        }

        $owner = $args['owner'] ?? '';
        $repo = $args['repo'] ?? '';

        if (empty($owner) || empty($repo)) {
            return ToolResult::error('Both owner and repo are required.');
        }

        try {
            $params = [];

            $mapping = [
                'state' => 'state',
                'labels' => 'labels',
                'sort' => 'sort',
                'direction' => 'direction',
                'per_page' => 'per_page',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->listIssues($owner, $repo, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
