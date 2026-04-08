<?php

namespace OpenCompany\Integrations\GitLab\Tools;

use OpenCompany\Integrations\GitLab\GitLabService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List GitLab groups visible to the authenticated user.
 */
class GitLabListGroups implements Tool
{
    /**
     * @param  GitLabService  $service  The GitLab API client
     */
    public function __construct(
        private GitLabService $service,
    ) {}

    public function name(): string
    {
        return 'gitlab_list_groups';
    }

    public function description(): string
    {
        return 'List GitLab groups visible to the authenticated user. Paginated.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination. Default: 1.'],
            'per_page' => ['type' => 'integer', 'description' => 'Results per page (1-100). Default: 20.'],
        ];
    }

    /**
     * Retrieve groups with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page, per_page)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitLab is not configured. Missing API token.');
        }

        try {
            $params = [];

            $mapping = [
                'page' => 'page',
                'per_page' => 'per_page',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->listGroups($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
