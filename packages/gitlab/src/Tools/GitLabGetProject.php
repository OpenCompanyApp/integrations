<?php

namespace OpenCompany\Integrations\GitLab\Tools;

use OpenCompany\Integrations\GitLab\GitLabService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific GitLab project.
 */
class GitLabGetProject implements Tool
{
    /**
     * @param  GitLabService  $service  The GitLab API client
     */
    public function __construct(
        private GitLabService $service,
    ) {}

    public function name(): string
    {
        return 'gitlab_get_project';
    }

    public function description(): string
    {
        return 'Get details for a specific GitLab project, including name, description, default branch, visibility, and statistics.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or URL-encoded path of the project (e.g. "123" or "group%2Fproject").'],
        ];
    }

    /**
     * Retrieve project details including name, description, and statistics.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id)
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
            $result = $this->service->getProject($projectId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
