<?php

namespace OpenCompany\Integrations\Jira\Tools;

use OpenCompany\Integrations\Jira\JiraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new issue in a Jira project.
 */
class JiraCreateIssue implements Tool
{
    /** @param  JiraService  $service  The Jira API client */
    public function __construct(
        private JiraService $service,
    ) {}

    public function name(): string
    {
        return 'jira_create_issue';
    }

    public function description(): string
    {
        return 'Create a new issue in a Jira project. Requires project_key, summary, and issue_type. Optionally set description, priority, assignee, and labels.';
    }

    public function parameters(): array
    {
        return [
            'project_key' => ['type' => 'string', 'required' => true, 'description' => 'The project key (e.g. PROJ).'],
            'summary' => ['type' => 'string', 'required' => true, 'description' => 'The summary (title) of the issue.'],
            'description' => ['type' => 'string', 'description' => 'The description of the issue. Supports Jira wiki markup or plain text.'],
            'issue_type' => ['type' => 'string', 'description' => 'The issue type name (e.g. Task, Bug, Story, Epic). Default: Task.'],
            'priority' => ['type' => 'string', 'description' => 'The priority name (e.g. High, Medium, Low).'],
            'assignee' => ['type' => 'string', 'description' => 'The account ID of the user to assign.'],
            'labels' => ['type' => 'array', 'description' => 'Array of label strings to apply. Example: ["backend", "urgent"].'],
        ];
    }

    /**
     * Create a Jira issue with project key, summary, and optional fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_key, summary, description, issue_type, priority, assignee, labels)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Jira is not configured. Missing API token.');
        }

        $projectKey = $args['project_key'] ?? '';
        $summary = $args['summary'] ?? '';

        if (empty($projectKey)) {
            return ToolResult::error('Project key is required.');
        }

        if (empty($summary)) {
            return ToolResult::error('Issue summary is required.');
        }

        try {
            $fields = [
                'project' => ['key' => $projectKey],
                'summary' => $summary,
                'issuetype' => ['name' => $args['issue_type'] ?? 'Task'],
            ];

            if (isset($args['description'])) {
                $fields['description'] = [
                    'type' => 'doc',
                    'version' => 1,
                    'content' => [
                        [
                            'type' => 'paragraph',
                            'content' => [
                                ['type' => 'text', 'text' => $args['description']],
                            ],
                        ],
                    ],
                ];
            }

            if (isset($args['priority'])) {
                $fields['priority'] = ['name' => $args['priority']];
            }

            if (isset($args['assignee'])) {
                $fields['assignee'] = ['accountId' => $args['assignee']];
            }

            if (isset($args['labels'])) {
                $fields['labels'] = $args['labels'];
            }

            $result = $this->service->createIssue($fields);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
