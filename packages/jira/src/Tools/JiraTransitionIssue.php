<?php

namespace OpenCompany\Integrations\Jira\Tools;

use OpenCompany\Integrations\Jira\JiraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Transition (change status of) a Jira issue.
 */
class JiraTransitionIssue implements Tool
{
    /** @param  JiraService  $service  The Jira API client */
    public function __construct(
        private JiraService $service,
    ) {}

    public function name(): string
    {
        return 'jira_transition_issue';
    }

    public function description(): string
    {
        return 'Transition a Jira issue to a new status. Use jira_get_transitions first to find the available transition IDs for the issue.';
    }

    public function parameters(): array
    {
        return [
            'issue_key' => ['type' => 'string', 'required' => true, 'description' => 'The issue key (e.g. PROJ-123).'],
            'transition_id' => ['type' => 'string', 'required' => true, 'description' => 'The transition ID to execute. Use jira_get_transitions to find valid IDs.'],
        ];
    }

    /**
     * Transition the specified Jira issue using the given transition ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (issue_key, transition_id)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Jira is not configured. Missing API token.');
        }

        $issueKey = $args['issue_key'] ?? '';
        $transitionId = $args['transition_id'] ?? '';

        if (empty($issueKey)) {
            return ToolResult::error('Issue key is required.');
        }

        if (empty($transitionId)) {
            return ToolResult::error('Transition ID is required. Use jira_get_transitions to find valid IDs.');
        }

        try {
            $result = $this->service->transitionIssue($issueKey, $transitionId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
