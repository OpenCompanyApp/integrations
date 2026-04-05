<?php

namespace OpenCompany\Integrations\GitLab\Tools;

use OpenCompany\Integrations\GitLab\GitLabService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new issue in a GitLab project.
 */
class GitLabCreateIssue implements Tool
{
    /**
     * @param  GitLabService  $service  The GitLab API client
     */
    public function __construct(
        private GitLabService $service,
    ) {}

    public function name(): string
    {
        return 'gitlab_create_issue';
    }

    public function description(): string
    {
        return 'Create a new issue in a GitLab project. Requires a project ID and title. Optionally set description, labels, assignees, milestone, and weight.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or URL-encoded path of the project (e.g. "123" or "group%2Fproject").'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title of the issue.'],
            'description' => ['type' => 'string', 'description' => 'The description of the issue. Supports GitLab Markdown.'],
            'labels' => ['type' => 'string', 'description' => 'Comma-separated label names to apply. Example: "bug,urgent".'],
            'assignee_ids' => ['type' => 'array', 'description' => 'Array of user IDs to assign. Example: [1, 2].'],
            'milestone_id' => ['type' => 'integer', 'description' => 'The milestone ID to associate with the issue.'],
            'weight' => ['type' => 'integer', 'description' => 'The weight of the issue (0-9).'],
        ];
    }

    /**
     * Create an issue with optional description, labels, assignees, milestone, and weight.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, title, description, labels, assignee_ids, milestone_id, weight)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('GitLab is not configured. Missing API token.');
        }

        $projectId = $args['project_id'] ?? '';
        $title = $args['title'] ?? '';

        if (empty($projectId)) {
            return ToolResult::error('project_id is required.');
        }

        if (empty($title)) {
            return ToolResult::error('Issue title is required.');
        }

        try {
            $params = [];

            $mapping = [
                'title' => 'title',
                'description' => 'description',
                'labels' => 'labels',
                'assignee_ids' => 'assignee_ids',
                'milestone_id' => 'milestone_id',
                'weight' => 'weight',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->createIssue($projectId, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
