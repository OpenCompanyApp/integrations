<?php

namespace OpenCompany\Integrations\Jira\Tools;

use OpenCompany\Integrations\Jira\JiraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Jira issue.
 */
class JiraDeleteIssue implements Tool
{
    /** @param  JiraService  $service  The Jira API client */
    public function __construct(
        private JiraService $service,
    ) {}

    public function name(): string
    {
        return 'jira_delete_issue';
    }

    public function description(): string
    {
        return 'Delete a Jira issue by its key. This action is irreversible.';
    }

    public function parameters(): array
    {
        return [
            'key' => ['type' => 'string', 'required' => true, 'description' => 'The issue key to delete (e.g. PROJ-123).'],
        ];
    }

    /**
     * Delete the specified Jira issue.
     *
     * @param  array<string, mixed>  $args  Tool arguments (key)
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
            $result = $this->service->deleteIssue($key);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
