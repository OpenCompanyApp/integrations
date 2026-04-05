<?php

namespace OpenCompany\Integrations\GitLab\Tools;

use OpenCompany\Integrations\GitLab\GitLabService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List members of a GitLab project.
 */
class GitLabListProjectMembers implements Tool
{
    /**
     * @param  GitLabService  $service  The GitLab API client
     */
    public function __construct(
        private GitLabService $service,
    ) {}

    public function name(): string
    {
        return 'gitlab_list_project_members';
    }

    public function description(): string
    {
        return 'List members of a GitLab project and their access levels. Paginated.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or URL-encoded path of the project.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination. Default: 1.'],
        ];
    }

    /**
     * Retrieve project members with their access levels.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, page)
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

            if (isset($args['page'])) {
                $params['page'] = $args['page'];
            }

            $result = $this->service->listProjectMembers($projectId, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
