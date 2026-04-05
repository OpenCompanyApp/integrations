<?php

namespace OpenCompany\Integrations\GitLab\Tools;

use OpenCompany\Integrations\GitLab\GitLabService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing issue in a GitLab project.
 */
class GitLabUpdateIssue implements Tool
{
    /**
     * @param  GitLabService  $service  The GitLab API client
     */
    public function __construct(
        private GitLabService $service,
    ) {}

    public function name(): string
    {
        return 'gitlab_update_issue';
    }

    public function description(): string
    {
        return 'Update an existing issue in a GitLab project. Can change title, description, labels, state (close/reopen), and assignees.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or URL-encoded path of the project.'],
            'issue_iid' => ['type' => 'integer', 'required' => true, 'description' => 'The project-scoped issue IID to update.'],
            'title' => ['type' => 'string', 'description' => 'New title for the issue.'],
            'description' => ['type' => 'string', 'description' => 'New description for the issue. Supports GitLab Markdown.'],
            'labels' => ['type' => 'string', 'description' => 'Comma-separated label names. Replaces existing labels. Example: "bug,urgent".'],
            'state_event' => ['type' => 'string', 'description' => 'State transition action: "close" to close, "reopen" to reopen.'],
            'assignee_ids' => ['type' => 'array', 'description' => 'Array of user IDs to assign. Replaces existing assignees.'],
        ];
    }

    /**
     * Update an issue's title, description, labels, state, or assignees.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, issue_iid, title, description, labels, state_event, assignee_ids)
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
            $params = [];

            $mapping = [
                'title' => 'title',
                'description' => 'description',
                'labels' => 'labels',
                'state_event' => 'state_event',
                'assignee_ids' => 'assignee_ids',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (array_key_exists($argKey, $args)) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->updateIssue($projectId, (int) $issueIid, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
