<?php

namespace OpenCompany\Integrations\GitLab\Tools;

use OpenCompany\Integrations\GitLab\GitLabService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List branches in a GitLab project repository.
 */
class GitLabListBranches implements Tool
{
    /**
     * @param  GitLabService  $service  The GitLab API client
     */
    public function __construct(
        private GitLabService $service,
    ) {}

    public function name(): string
    {
        return 'gitlab_list_branches';
    }

    public function description(): string
    {
        return 'List branches in a GitLab project repository. Supports searching by branch name and pagination.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or URL-encoded path of the project.'],
            'search' => ['type' => 'string', 'description' => 'Search term to filter branches by name.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination. Default: 1.'],
        ];
    }

    /**
     * Retrieve branches with optional name search filtering.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, search, page)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitLab is not configured. Missing API token.');
        }

        $projectId = $args['project_id'] ?? '';

        if (empty($projectId)) {
            return ToolResult::error('project_id is required.');
        }

        try {
            $params = [];

            $mapping = [
                'search' => 'search',
                'page' => 'page',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->listBranches($projectId, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
