<?php

namespace OpenCompany\Integrations\Jira\Tools;

use OpenCompany\Integrations\Jira\JiraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search for Jira users.
 */
class JiraSearchUsers implements Tool
{
    /** @param  JiraService  $service  The Jira API client */
    public function __construct(
        private JiraService $service,
    ) {}

    public function name(): string
    {
        return 'jira_search_users';
    }

    public function description(): string
    {
        return 'Search for Jira users by name or email. Returns account IDs needed for assigning issues.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Search query (name or email substring).'],
            'max_results' => ['type' => 'integer', 'description' => 'Maximum number of results to return. Default: 10.'],
        ];
    }

    /**
     * Search for Jira users matching the query string.
     *
     * @param  array<string, mixed>  $args  Tool arguments (query, max_results)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Jira is not configured. Missing API token.');
        }

        $query = $args['query'] ?? '';

        if (empty($query)) {
            return ToolResult::error('Search query is required.');
        }

        try {
            $params = ['query' => $query];

            if (isset($args['max_results'])) {
                $params['maxResults'] = (int) $args['max_results'];
            }

            $result = $this->service->searchUsers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
