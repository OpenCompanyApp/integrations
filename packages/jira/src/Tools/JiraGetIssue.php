<?php

namespace OpenCompany\Integrations\Jira\Tools;

use OpenCompany\Integrations\Jira\JiraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Jira issue.
 */
class JiraGetIssue implements Tool
{
    /** @param  JiraService  $service  The Jira API client */
    public function __construct(
        private JiraService $service,
    ) {}

    public function name(): string
    {
        return 'jira_get_issue';
    }

    public function description(): string
    {
        return 'Get details for a specific Jira issue by its key (e.g. PROJ-123). Returns summary, status, assignee, description, and all fields.';
    }

    public function parameters(): array
    {
        return [
            'key' => ['type' => 'string', 'required' => true, 'description' => 'The issue key (e.g. PROJ-123).'],
        ];
    }

    /**
     * Retrieve a Jira issue by its key.
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
            $result = $this->service->getIssue($key);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
