<?php

namespace OpenCompany\Integrations\GitLab\Tools;

use OpenCompany\Integrations\GitLab\GitLabService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a specific GitLab issue.
 */
class GitLabGetIssue implements Tool
{
    /**
     * @param  GitLabService  $service  The GitLab API client
     */
    public function __construct(
        private GitLabService $service,
    ) {}

    public function name(): string
    {
        return 'gitlab_get_issue';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific GitLab issue, including title, description, labels, assignees, milestone, and state.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or URL-encoded path of the project.'],
            'issue_iid' => ['type' => 'integer', 'required' => true, 'description' => 'The project-scoped issue IID (not the global ID).'],
        ];
    }

    /**
     * Retrieve issue details including title, description, labels, and assignees.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, issue_iid)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitLab is not configured. Missing API token.');
        }

        $projectId = $args['project_id'] ?? '';
        $issueIid = $args['issue_iid'] ?? null;

        if (empty($projectId)) {
            return ToolResult::error('project_id is required.');
        }

        if ($issueIid === null) {
            return ToolResult::error('issue_iid is required.');
        }

        try {
            $result = $this->service->getIssue($projectId, (int) $issueIid);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
