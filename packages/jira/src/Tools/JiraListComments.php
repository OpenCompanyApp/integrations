<?php

namespace OpenCompany\Integrations\Jira\Tools;

use OpenCompany\Integrations\Jira\JiraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List comments on a Jira issue.
 */
class JiraListComments implements Tool
{
    /** @param  JiraService  $service  The Jira API client */
    public function __construct(
        private JiraService $service,
    ) {}

    public function name(): string
    {
        return 'jira_list_comments';
    }

    public function description(): string
    {
        return 'List all comments on a Jira issue. Returns comment body, author, and creation date.';
    }

    public function parameters(): array
    {
        return [
            'issue_key' => ['type' => 'string', 'required' => true, 'description' => 'The issue key (e.g. PROJ-123).'],
        ];
    }

    /**
     * Retrieve all comments for the specified Jira issue.
     *
     * @param  array<string, mixed>  $args  Tool arguments (issue_key)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Jira is not configured. Missing API token.');
        }

        $issueKey = $args['issue_key'] ?? '';

        if (empty($issueKey)) {
            return ToolResult::error('Issue key is required.');
        }

        try {
            $result = $this->service->listComments($issueKey);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
