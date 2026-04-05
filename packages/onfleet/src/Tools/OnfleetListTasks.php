<?php

namespace OpenCompany\Integrations\Onfleet\Tools;

use OpenCompany\Integrations\Onfleet\OnfleetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List delivery tasks from Onfleet with optional filters.
 *
 * Supports filtering by state, worker, organization, and time-based queries.
 * Returns paginated task results with full task details.
 */
class OnfleetListTasks implements Tool
{
    public function __construct(
        private OnfleetService $service,
    ) {}

    public function name(): string
    {
        return 'onfleet_list_tasks';
    }

    public function description(): string
    {
        return 'List delivery tasks from Onfleet. Filter by state (0=unassigned, 1=assigned, 2=active, 3=completed), worker, team, or time range. Returns task details including destination, recipient, and completion status.';
    }

    public function parameters(): array
    {
        return [
            'state' => ['type' => 'integer', 'description' => 'Task state filter: 0=unassigned, 1=assigned, 2=active, 3=completed.'],
            'worker' => ['type' => 'string', 'description' => 'Filter tasks assigned to a specific worker ID.'],
            'organization' => ['type' => 'string', 'description' => 'Filter tasks by organization ID.'],
            'team' => ['type' => 'string', 'description' => 'Filter tasks by team ID.'],
            'completeBeforeAfter' => ['type' => 'string', 'description' => 'ISO 8601 timestamp — list tasks completed after this time.'],
            'completeBeforeBefore' => ['type' => 'string', 'description' => 'ISO 8601 timestamp — list tasks with completeBefore before this time.'],
            'from' => ['type' => 'string', 'description' => 'ISO 8601 timestamp — list tasks created after this time.'],
            'to' => ['type' => 'string', 'description' => 'ISO 8601 timestamp — list tasks created before this time.'],
            'lastUpdated' => ['type' => 'string', 'description' => 'ISO 8601 timestamp — list tasks updated after this time.'],
            'query' => ['type' => 'string', 'description' => 'Search query to filter tasks by recipient name, notes, or tracking URL.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Onfleet integration is not configured.');
            }

            $query = [];

            // Build query parameters from provided arguments
            $params = ['state', 'worker', 'organization', 'team', 'completeBeforeAfter', 'completeBeforeBefore', 'from', 'to', 'lastUpdated', 'query'];
            foreach ($params as $param) {
                if (isset($args[$param])) {
                    $query[$param] = $args[$param];
                }
            }

            $result = $this->service->listTasks($query);

            $tasks = $result['tasks'] ?? $result;

            $output = [
                'tasks' => $tasks,
                'count' => is_array($tasks) ? count($tasks) : 0,
            ];

            if (isset($result['metadata'])) {
                $output['metadata'] = $result['metadata'];
            }

            return ToolResult::success($output);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
