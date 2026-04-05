<?php

namespace OpenCompany\Integrations\Jira\Tools;

use OpenCompany\Integrations\Jira\JiraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List issues in a Jira sprint.
 */
class JiraListSprintIssues implements Tool
{
    /** @param  JiraService  $service  The Jira API client */
    public function __construct(
        private JiraService $service,
    ) {}

    public function name(): string
    {
        return 'jira_list_sprint_issues';
    }

    public function description(): string
    {
        return 'List issues in a specific Jira sprint. Supports pagination with start_at and max_results.';
    }

    public function parameters(): array
    {
        return [
            'sprint_id' => ['type' => 'integer', 'required' => true, 'description' => 'The sprint ID. Use jira_list_sprints to find sprint IDs.'],
            'start_at' => ['type' => 'integer', 'description' => 'Offset for pagination (0-based). Default: 0.'],
            'max_results' => ['type' => 'integer', 'description' => 'Maximum number of results per page (1-100). Default: 50.'],
        ];
    }

    /**
     * Retrieve issues for the specified Jira sprint.
     *
     * @param  array<string, mixed>  $args  Tool arguments (sprint_id, start_at, max_results)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Jira is not configured. Missing API token.');
        }

        $sprintId = $args['sprint_id'] ?? '';

        if (empty($sprintId)) {
            return ToolResult::error('Sprint ID is required.');
        }

        try {
            $params = [];

            if (isset($args['start_at'])) {
                $params['startAt'] = (int) $args['start_at'];
            }

            if (isset($args['max_results'])) {
                $params['maxResults'] = (int) $args['max_results'];
            }

            $result = $this->service->listSprintIssues((int) $sprintId, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
