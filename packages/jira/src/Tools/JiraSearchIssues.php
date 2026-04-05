<?php

namespace OpenCompany\Integrations\Jira\Tools;

use OpenCompany\Integrations\Jira\JiraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search for Jira issues using JQL (Jira Query Language).
 */
class JiraSearchIssues implements Tool
{
    /** @param  JiraService  $service  The Jira API client */
    public function __construct(
        private JiraService $service,
    ) {}

    public function name(): string
    {
        return 'jira_search_issues';
    }

    public function description(): string
    {
        return 'Search for Jira issues using JQL (Jira Query Language). Examples: "project = PROJ AND status = Open", "assignee = currentUser() ORDER BY created DESC".';
    }

    public function parameters(): array
    {
        return [
            'jql' => ['type' => 'string', 'required' => true, 'description' => 'JQL query string. Example: "project = PROJ AND status = Open".'],
            'start_at' => ['type' => 'integer', 'description' => 'Offset for pagination (0-based). Default: 0.'],
            'max_results' => ['type' => 'integer', 'description' => 'Maximum number of results per page (1-100). Default: 50.'],
            'fields' => ['type' => 'string', 'description' => 'Comma-separated list of field names to return. Example: "summary,status,assignee".'],
        ];
    }

    /**
     * Search Jira issues using a JQL query with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (jql, start_at, max_results, fields)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Jira is not configured. Missing API token.');
        }

        $jql = $args['jql'] ?? '';

        if (empty($jql)) {
            return ToolResult::error('JQL query is required.');
        }

        try {
            $params = ['jql' => $jql];

            if (isset($args['start_at'])) {
                $params['startAt'] = (int) $args['start_at'];
            }

            if (isset($args['max_results'])) {
                $params['maxResults'] = (int) $args['max_results'];
            }

            if (isset($args['fields'])) {
                $params['fields'] = $args['fields'];
            }

            $result = $this->service->searchIssues($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
