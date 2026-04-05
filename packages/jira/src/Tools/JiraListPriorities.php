<?php

namespace OpenCompany\Integrations\Jira\Tools;

use OpenCompany\Integrations\Jira\JiraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all available Jira issue priorities.
 */
class JiraListPriorities implements Tool
{
    /** @param  JiraService  $service  The Jira API client */
    public function __construct(
        private JiraService $service,
    ) {}

    public function name(): string
    {
        return 'jira_list_priorities';
    }

    public function description(): string
    {
        return 'List all available issue priorities in Jira. Returns priority names and IDs needed when creating or updating issues.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve all available Jira issue priorities.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Jira is not configured. Missing API token.');
        }

        try {
            $result = $this->service->listPriorities();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
