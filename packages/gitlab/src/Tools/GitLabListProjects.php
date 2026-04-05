<?php

namespace OpenCompany\Integrations\GitLab\Tools;

use OpenCompany\Integrations\GitLab\GitLabService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List GitLab projects visible to the authenticated user.
 */
class GitLabListProjects implements Tool
{
    /**
     * @param  GitLabService  $service  The GitLab API client
     */
    public function __construct(
        private GitLabService $service,
    ) {}

    public function name(): string
    {
        return 'gitlab_list_projects';
    }

    public function description(): string
    {
        return 'List GitLab projects visible to the authenticated user. Supports filtering by membership, search text, and pagination.';
    }

    public function parameters(): array
    {
        return [
            'membership' => ['type' => 'boolean', 'description' => 'Limit to projects where the user is a member. Default: false.'],
            'search' => ['type' => 'string', 'description' => 'Search term to filter projects by name or path.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination. Default: 1.'],
            'per_page' => ['type' => 'integer', 'description' => 'Results per page (1-100). Default: 20.'],
        ];
    }

    /**
     * Retrieve projects with optional filtering by membership and search text.
     *
     * @param  array<string, mixed>  $args  Tool arguments (membership, search, page, per_page)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitLab is not configured. Missing API token.');
        }

        try {
            $params = [];

            $mapping = [
                'membership' => 'membership',
                'search' => 'search',
                'page' => 'page',
                'per_page' => 'per_page',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->listProjects($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
