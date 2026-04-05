<?php

namespace OpenCompany\Integrations\Jira\Tools;

use OpenCompany\Integrations\Jira\JiraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Assign a Jira issue to a user.
 */
class JiraAssignIssue implements Tool
{
    /** @param  JiraService  $service  The Jira API client */
    public function __construct(
        private JiraService $service,
    ) {}

    public function name(): string
    {
        return 'jira_assign_issue';
    }

    public function description(): string
    {
        return 'Assign a Jira issue to a user by their Atlassian account ID. Use jira_search_users to find account IDs.';
    }

    public function parameters(): array
    {
        return [
            'issue_key' => ['type' => 'string', 'required' => true, 'description' => 'The issue key (e.g. PROJ-123).'],
            'account_id' => ['type' => 'string', 'required' => true, 'description' => 'The Atlassian account ID of the user to assign.'],
        ];
    }

    /**
     * Assign the specified Jira issue to a user by account ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (issue_key, account_id)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Jira is not configured. Missing API token.');
        }

        $issueKey = $args['issue_key'] ?? '';
        $accountId = $args['account_id'] ?? '';

        if (empty($issueKey)) {
            return ToolResult::error('Issue key is required.');
        }

        if (empty($accountId)) {
            return ToolResult::error('Account ID is required.');
        }

        try {
            $result = $this->service->assignIssue($issueKey, $accountId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
