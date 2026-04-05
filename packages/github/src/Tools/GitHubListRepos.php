<?php

namespace OpenCompany\Integrations\GitHub\Tools;

use OpenCompany\Integrations\GitHub\GitHubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List repositories for the authenticated GitHub user.
 */
class GitHubListRepos implements Tool
{
    /** @param  GitHubService  $service  The GitHub API client */
    public function __construct(
        private GitHubService $service,
    ) {}

    public function name(): string
    {
        return 'github_list_repos';
    }

    public function description(): string
    {
        return 'List repositories for the authenticated GitHub user. Supports filtering by type (all, owner, public, private, member), sorting (created, updated, pushed, full_name), and direction.';
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'description' => 'Repository type filter: all, owner, public, private, member. Default: all.'],
            'sort' => ['type' => 'string', 'description' => 'Sort field: created, updated, pushed, full_name. Default: full_name.'],
            'direction' => ['type' => 'string', 'description' => 'Sort direction: asc or desc. Default: asc when using full_name, desc otherwise.'],
            'per_page' => ['type' => 'integer', 'description' => 'Results per page (1-100). Default: 30.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination. Default: 1.'],
        ];
    }

    /**
     * Retrieve repositories with optional filtering by type and sort order.
     *
     * @param  array<string, mixed>  $args  Tool arguments (type, sort, direction, per_page, page)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitHub is not configured. Missing API key.');
        }

        try {
            $params = [];

            $mapping = [
                'type' => 'type',
                'sort' => 'sort',
                'direction' => 'direction',
                'per_page' => 'per_page',
                'page' => 'page',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->listRepos($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
