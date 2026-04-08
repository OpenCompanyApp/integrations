<?php

namespace OpenCompany\Integrations\GitLab\Tools;

use OpenCompany\Integrations\GitLab\GitLabService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List merge requests in a GitLab project.
 */
class GitLabListMergeRequests implements Tool
{
    /**
     * @param  GitLabService  $service  The GitLab API client
     */
    public function __construct(
        private GitLabService $service,
    ) {}

    public function name(): string
    {
        return 'gitlab_list_merge_requests';
    }

    public function description(): string
    {
        return 'List merge requests in a GitLab project. Supports filtering by state (opened, closed, merged, all). Paginated.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or URL-encoded path of the project.'],
            'state' => ['type' => 'string', 'description' => 'Merge request state filter: opened, closed, merged, all. Default: opened.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination. Default: 1.'],
            'per_page' => ['type' => 'integer', 'description' => 'Results per page (1-100). Default: 20.'],
        ];
    }

    /**
     * Retrieve merge requests with optional filtering by state.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, state, page, per_page)
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
                'state' => 'state',
                'page' => 'page',
                'per_page' => 'per_page',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->listMergeRequests($projectId, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
