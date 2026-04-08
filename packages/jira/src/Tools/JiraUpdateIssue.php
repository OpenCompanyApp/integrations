<?php

namespace OpenCompany\Integrations\Jira\Tools;

use OpenCompany\Integrations\Jira\JiraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing Jira issue.
 */
class JiraUpdateIssue implements Tool
{
    /** @param  JiraService  $service  The Jira API client */
    public function __construct(
        private JiraService $service,
    ) {}

    public function name(): string
    {
        return 'jira_update_issue';
    }

    public function description(): string
    {
        return 'Update an existing Jira issue. Provide the issue key and any fields to update (summary, description, priority, assignee).';
    }

    public function parameters(): array
    {
        return [
            'key' => ['type' => 'string', 'required' => true, 'description' => 'The issue key (e.g. PROJ-123).'],
            'summary' => ['type' => 'string', 'description' => 'The new summary (title) of the issue.'],
            'description' => ['type' => 'string', 'description' => 'The new description of the issue.'],
            'priority' => ['type' => 'string', 'description' => 'The new priority name (e.g. High, Medium, Low).'],
            'assignee' => ['type' => 'string', 'description' => 'The account ID of the new assignee.'],
        ];
    }

    /**
     * Update a Jira issue with the provided fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments (key, summary, description, priority, assignee)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Jira is not configured. Missing API token.');
        }

        $key = $args['key'] ?? '';

        if (empty($key)) {
            return ToolResult::error('Issue key is required.');
        }

        try {
            $fields = [];

            if (isset($args['summary'])) {
                $fields['summary'] = $args['summary'];
            }

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

            if (empty($fields)) {
                return ToolResult::error('At least one field to update is required.');
            }

            $result = $this->service->updateIssue($key, $fields);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
