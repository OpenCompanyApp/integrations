<?php

namespace OpenCompany\Integrations\Linear\Tools;

use OpenCompany\Integrations\Linear\LinearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search Linear issues using flexible filter criteria across all teams.
 */
class LinearSearchIssues implements Tool
{
    /**
     * @param  LinearService  $service  The Linear API client
     */
    public function __construct(
        private LinearService $service,
    ) {}

    public function name(): string
    {
        return 'linear_search_issues';
    }

    public function description(): string
    {
        return <<<'MD'
        Search Linear issues using filter criteria. Supports filtering by
        text query, team, state name, assignee, and priority.
        Returns matching issues with pagination info.
        MD;
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'description' => 'Text to search in issue titles and descriptions.'],
            'team_id' => ['type' => 'string', 'description' => 'Filter by team ID.'],
            'state' => ['type' => 'string', 'description' => 'Filter by state name (e.g., "In Progress", "Done").'],
            'assignee_id' => ['type' => 'string', 'description' => 'Filter by assignee user ID.'],
            'priority' => ['type' => 'integer', 'description' => 'Filter by priority: 0=none, 1=urgent, 2=high, 3=medium, 4=low.'],
            'limit' => ['type' => 'integer', 'description' => 'Max results to return. Default: 20.'],
        ];
    }

    /**
     * Search Linear issues using the provided filter criteria.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Linear integration is not configured.');
            }

            $filter = [];

            if (! empty($args['query'])) {
                $filter['or'] = [
                    ['title' => ['contains' => $args['query']]],
                    ['description' => ['contains' => $args['query']]],
                ];
            }
            if (! empty($args['team_id'])) {
                $filter['team'] = ['id' => ['eq' => $args['team_id']]];
            }
            if (! empty($args['state'])) {
                $filter['state'] = ['name' => ['eq' => $args['state']]];
            }
            if (! empty($args['assignee_id'])) {
                $filter['assignee'] = ['id' => ['eq' => $args['assignee_id']]];
            }
            if (isset($args['priority'])) {
                $filter['priority'] = ['eq' => (int) $args['priority']];
            }

            $limit = (int) ($args['limit'] ?? 20);

            $result = $this->service->searchIssues($filter, $limit);
            $issues = $result['data']['issues'] ?? [];

            $nodes = array_map(function (array $issue) {
                return [
                    'id' => $issue['id'] ?? '',
                    'identifier' => $issue['identifier'] ?? '',
                    'title' => $issue['title'] ?? '',
                    'state' => $issue['state']['name'] ?? '',
                    'assignee' => $issue['assignee']['name'] ?? null,
                    'priority' => $issue['priority'] ?? null,
                    'team' => isset($issue['team']) ? $issue['team']['key'] : null,
                    'labels' => array_map(fn (array $l) => $l['name'] ?? '', $issue['labels']['nodes'] ?? []),
                    'created_at' => $issue['createdAt'] ?? '',
                ];
            }, $issues['nodes'] ?? []);

            $pageInfo = $issues['pageInfo'] ?? [];

            return ToolResult::success([
                'issues' => $nodes,
                'total' => count($nodes),
                'has_next_page' => $pageInfo['hasNextPage'] ?? false,
                'end_cursor' => $pageInfo['endCursor'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
