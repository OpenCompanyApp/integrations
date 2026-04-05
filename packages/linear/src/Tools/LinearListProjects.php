<?php

namespace OpenCompany\Integrations\Linear\Tools;

use OpenCompany\Integrations\Linear\LinearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Linear projects with cursor-based pagination.
 */
class LinearListProjects implements Tool
{
    /**
     * @param  LinearService  $service  The Linear API client
     */
    public function __construct(
        private LinearService $service,
    ) {}

    public function name(): string
    {
        return 'linear_list_projects';
    }

    public function description(): string
    {
        return <<<'MD'
        List Linear projects with optional cursor-based pagination.
        Returns project details including state, dates, lead, and associated teams.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Results per page. Default: 25.'],
            'after' => ['type' => 'string', 'description' => 'Cursor for next page (from previous response endCursor).'],
        ];
    }

    /**
     * List Linear projects with pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Linear integration is not configured.');
            }

            $limit = (int) ($args['limit'] ?? 25);
            $after = $args['after'] ?? null;

            $result = $this->service->listProjects($limit, $after);
            $projects = $result['data']['projects'] ?? [];

            $nodes = array_map(function (array $project) {
                return [
                    'id' => $project['id'] ?? '',
                    'name' => $project['name'] ?? '',
                    'description' => $project['description'] ?? '',
                    'state' => $project['state'] ?? '',
                    'start_date' => $project['startDate'] ?? null,
                    'target_date' => $project['targetDate'] ?? null,
                    'lead' => isset($project['lead']) ? $project['lead']['name'] : null,
                    'teams' => array_map(fn (array $t) => [
                        'id' => $t['id'] ?? '',
                        'name' => $t['name'] ?? '',
                        'key' => $t['key'] ?? '',
                    ], $project['teams']['nodes'] ?? []),
                    'created_at' => $project['createdAt'] ?? '',
                    'updated_at' => $project['updatedAt'] ?? '',
                ];
            }, $projects['nodes'] ?? []);

            $pageInfo = $projects['pageInfo'] ?? [];

            return ToolResult::success([
                'projects' => $nodes,
                'total' => count($nodes),
                'has_next_page' => $pageInfo['hasNextPage'] ?? false,
                'end_cursor' => $pageInfo['endCursor'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
