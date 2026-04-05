<?php

namespace OpenCompany\Integrations\TickTick\Tools;

use OpenCompany\Integrations\TickTick\TickTickService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TickTickCreateTask implements Tool
{
    public function __construct(
        private TickTickService $service,
    ) {}

    public function name(): string
    {
        return 'ticktick_create_task';
    }

    public function description(): string
    {
        return 'Create a new task in TickTick. If no project_id is given, the task goes to the Inbox. Supports subtasks via the items array.';
    }

    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'Task title.'],
            'project_id' => ['type' => 'string', 'description' => 'Project ID to create the task in. Omit to add to Inbox.'],
            'content' => ['type' => 'string', 'description' => 'Task description/notes.'],
            'start_date' => ['type' => 'string', 'description' => 'Start date in ISO 8601 format (e.g., "2026-02-15T09:00:00+0000").'],
            'due_date' => ['type' => 'string', 'description' => 'Due date in ISO 8601 format (e.g., "2026-02-15T17:00:00+0000").'],
            'priority' => ['type' => 'integer', 'description' => 'Priority: 0 = none, 1 = low, 3 = medium, 5 = high.'],
            'is_all_day' => ['type' => 'boolean', 'description' => 'Whether this is an all-day task (true) or has specific times (false).'],
            'items' => ['type' => 'string', 'description' => 'JSON array of subtasks, e.g., [{"title": "Subtask 1", "status": 0}]. Status: 0 = unchecked, 2 = checked.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('TickTick integration is not configured.');
            }

            $data = ['title' => $args['title']];

            if (isset($args['project_id'])) {
                $data['projectId'] = $args['project_id'];
            }
            if (isset($args['content'])) {
                $data['content'] = $args['content'];
            }
            if (isset($args['start_date'])) {
                $data['startDate'] = $args['start_date'];
            }
            if (isset($args['due_date'])) {
                $data['dueDate'] = $args['due_date'];
            }
            if (isset($args['priority'])) {
                $data['priority'] = (int) $args['priority'];
            }
            if (isset($args['is_all_day'])) {
                $data['isAllDay'] = (bool) $args['is_all_day'];
            }
            if (isset($args['items'])) {
                $items = $args['items'];
                $data['items'] = is_string($items) ? json_decode($items, true) : $items;
            }

            $result = $this->service->createTask($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
