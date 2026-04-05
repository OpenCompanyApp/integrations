<?php

namespace OpenCompany\Integrations\Jira\Tools;

use OpenCompany\Integrations\Jira\JiraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Jira user.
 */
class JiraGetUser implements Tool
{
    /** @param  JiraService  $service  The Jira API client */
    public function __construct(
        private JiraService $service,
    ) {}

    public function name(): string
    {
        return 'jira_get_user';
    }

    public function description(): string
    {
        return 'Get details for a specific Jira user by their Atlassian account ID.';
    }

    public function parameters(): array
    {
        return [
            'account_id' => ['type' => 'string', 'required' => true, 'description' => 'The Atlassian account ID of the user.'],
        ];
    }

    /**
     * Retrieve a Jira user by their account ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (account_id)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Jira is not configured. Missing API token.');
        }

        $accountId = $args['account_id'] ?? '';

        if (empty($accountId)) {
            return ToolResult::error('Account ID is required.');
        }

        try {
            $result = $this->service->getUser($accountId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
