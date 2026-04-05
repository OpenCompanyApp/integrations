<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpGetTasks implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_get_tasks';
    }

    public function description(): string
    {
        return <<<'MD'
        Get all tasks in a ClickUp list.
        Supports filtering by statuses, assignees, and due dates.
        Use clickup_get_hierarchy first to find the list ID.
        MD;
    }

    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'List ID to get tasks from.'],
            'statuses' => ['type' => 'string', 'description' => 'Comma-separated statuses to filter by.'],
            'assignees' => ['type' => 'string', 'description' => 'Comma-separated assignee user IDs.'],
            'due_date_gt' => ['type' => 'string', 'description' => 'Only tasks with due date after this (ISO 8601, e.g., "2026-01-01").'],
            'due_date_lt' => ['type' => 'string', 'description' => 'Only tasks with due date before this (ISO 8601).'],
            'include_closed' => ['type' => 'boolean', 'description' => 'Include closed tasks. Default: false.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (starts at 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $listId = $args['list_id'] ?? '';
            if (empty($listId)) {
                return ToolResult::error('list_id is required.');
            }

            $params = [];

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

            if (isset($args['due_date_gt'])) {
                $params['due_date_gt'] = ClickUpService::toMillis($args['due_date_gt']);
            }

            if (isset($args['due_date_lt'])) {
                $params['due_date_lt'] = ClickUpService::toMillis($args['due_date_lt']);
            }

            if (isset($args['include_closed']) && $args['include_closed']) {
                $params['include_closed'] = 'true';
            }

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->getTasks($listId, $params);
            $tasks = $result['tasks'] ?? [];

            if (empty($tasks)) {
                return ToolResult::success('No tasks found in this list.');
            }

            $output = array_map(fn (array $task) => [
                'id' => $task['id'] ?? '',
                'custom_id' => $task['custom_id'] ?? null,
                'name' => $task['name'] ?? '',
                'status' => $task['status']['status'] ?? '',
                'priority' => $task['priority']['priority'] ?? null,
                'assignees' => array_map(fn (array $a) => $a['username'] ?? $a['id'], $task['assignees'] ?? []),
                'due_date' => isset($task['due_date']) ? ClickUpService::fromMillis((int) $task['due_date']) : null,
            ], $tasks);

            return ToolResult::success(['count' => count($output), 'tasks' => $output]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
