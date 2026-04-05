<?php

namespace OpenCompany\Integrations\GitLab\Tools;

use OpenCompany\Integrations\GitLab\GitLabService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a specific GitLab merge request.
 */
class GitLabGetMergeRequest implements Tool
{
    /**
     * @param  GitLabService  $service  The GitLab API client
     */
    public function __construct(
        private GitLabService $service,
    ) {}

    public function name(): string
    {
        return 'gitlab_get_merge_request';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific GitLab merge request, including title, description, source/target branches, and state.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or URL-encoded path of the project.'],
            'mr_iid' => ['type' => 'integer', 'required' => true, 'description' => 'The project-scoped merge request IID (not the global ID).'],
        ];
    }

    /**
     * Retrieve merge request details including branches, state, and pipeline status.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, mr_iid)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitLab is not configured. Missing API token.');
        }

        $projectId = $args['project_id'] ?? '';
        $mrIid = $args['mr_iid'] ?? null;

        if (empty($projectId)) {
            return ToolResult::error('project_id is required.');
        }

        if ($mrIid === null) {
            return ToolResult::error('mr_iid is required.');
        }

        try {
            $result = $this->service->getMergeRequest($projectId, (int) $mrIid);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
