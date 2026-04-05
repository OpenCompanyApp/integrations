<?php

namespace OpenCompany\Integrations\Linear\Tools;

use OpenCompany\Integrations\Linear\LinearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List issues for a specific Linear team with optional filters and cursor-based pagination.
 */
class LinearListIssues implements Tool
{
    /**
     * @param  LinearService  $service  The Linear API client
     */
    public function __construct(
        private LinearService $service,
    ) {}

    public function name(): string
    {
        return 'linear_list_issues';
    }

    public function description(): string
    {
        return <<<'MD'
        List issues for a specific Linear team. Supports filtering by status,
        assignee, and cursor-based pagination. Use linear_get_teams to find team IDs.
        MD;
    }

    public function parameters(): array
    {
        return [
            'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team ID to list issues for.'],
            'status' => ['type' => 'string', 'description' => 'Filter by state name (e.g., "In Progress", "Backlog").'],
            'assignee_id' => ['type' => 'string', 'description' => 'Filter by assignee user ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Results per page. Default: 25.'],
            'after' => ['type' => 'string', 'description' => 'Cursor for next page (from previous response endCursor).'],
        ];
    }

    /**
     * List issues for a Linear team with optional filters and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Linear integration is not configured.');
            }

            $teamId = $args['team_id'] ?? '';
            if (empty($teamId)) {
                return ToolResult::error('team_id is required.');
            }

            $filter = [];

            if (! empty($args['status'])) {
                $filter['state'] = ['name' => ['eq' => $args['status']]];
            }
            if (! empty($args['assignee_id'])) {
                $filter['assignee'] = ['id' => ['eq' => $args['assignee_id']]];
            }

            $limit = (int) ($args['limit'] ?? 25);
            $after = $args['after'] ?? null;

            $result = $this->service->listIssues($teamId, $filter, $limit, $after);
            $issues = $result['data']['issues'] ?? [];

            $nodes = array_map(function (array $issue) {
                return [
                    'id' => $issue['id'] ?? '',
                    'identifier' => $issue['identifier'] ?? '',
                    'title' => $issue['title'] ?? '',
                    'state' => $issue['state']['name'] ?? '',
                    'assignee' => $issue['assignee']['name'] ?? null,
                    'priority' => $issue['priority'] ?? null,
                    'labels' => array_map(fn (array $l) => $l['name'] ?? '', $issue['labels']['nodes'] ?? []),
                    'created_at' => $issue['createdAt'] ?? '',
                    'updated_at' => $issue['updatedAt'] ?? '',
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
