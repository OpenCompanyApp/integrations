<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpSearch implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_search';
    }

    public function description(): string
    {
        return <<<'MD'
        Search tasks across the ClickUp workspace.
        Supports filtering by query, statuses, assignees, and more.
        Returns matching tasks with their details.
        MD;
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'description' => 'Search query to match task names.'],
            'statuses' => ['type' => 'string', 'description' => 'Comma-separated statuses to filter by (e.g., "open,in progress").'],
            'assignees' => ['type' => 'string', 'description' => 'Comma-separated assignee user IDs.'],
            'include_closed' => ['type' => 'boolean', 'description' => 'Include closed tasks in results. Default: false.'],
            'include_subtasks' => ['type' => 'boolean', 'description' => 'Include subtasks in results. Default: false.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (starts at 0).'],
            'workspace_id' => ['type' => 'string', 'description' => 'Workspace ID. Uses configured default if omitted.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $workspaceId = $args['workspace_id'] ?? $this->service->getWorkspaceId();
            if (empty($workspaceId)) {
                return ToolResult::error('Workspace ID is required for search. Configure it in settings or pass workspace_id.');
            }

            $params = [];

            if (isset($args['query'])) {
                $params['name'] = $args['query'];
            }

            if (isset($args['statuses'])) {
                $statuses = is_string($args['statuses']) ? explode(',', $args['statuses']) : $args['statuses'];
                foreach ($statuses as $i => $status) {
                    $params["statuses[{$i}]"] = trim($status);
                }
            }

            if (isset($args['assignees'])) {
                $assignees = is_string($args['assignees']) ? explode(',', $args['assignees']) : $args['assignees'];
                foreach ($assignees as $i => $assignee) {
                    $params["assignees[{$i}]"] = trim($assignee);
                }
            }

            if (isset($args['include_closed']) && $args['include_closed']) {
                $params['include_closed'] = 'true';
            }

            if (isset($args['include_subtasks']) && $args['include_subtasks']) {
                $params['subtasks'] = 'true';
            }

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->searchTasks($workspaceId, $params);
            $tasks = $result['tasks'] ?? [];

            if (empty($tasks)) {
                return ToolResult::success('No tasks found matching the search criteria.');
            }

            $output = [];
            foreach ($tasks as $task) {
                $output[] = $this->formatTask($task);
            }

            return ToolResult::success(['count' => count($output), 'tasks' => $output]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * @param  array<string, mixed>  $task
     * @return array<string, mixed>
     */
    private function formatTask(array $task): array
    {
        return [
            'id' => $task['id'] ?? '',
            'custom_id' => $task['custom_id'] ?? null,
            'name' => $task['name'] ?? '',
            'status' => $task['status']['status'] ?? '',
            'priority' => $task['priority']['priority'] ?? null,
            'assignees' => array_map(fn (array $a) => $a['username'] ?? $a['email'] ?? $a['id'], $task['assignees'] ?? []),
            'due_date' => isset($task['due_date']) ? ClickUpService::fromMillis((int) $task['due_date']) : null,
            'url' => $task['url'] ?? '',
        ];
    }
}
