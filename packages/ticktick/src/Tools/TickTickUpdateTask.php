<?php

namespace OpenCompany\Integrations\TickTick\Tools;

use OpenCompany\Integrations\TickTick\TickTickService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TickTickUpdateTask implements Tool
{
    public function __construct(
        private TickTickService $service,
    ) {}

    public function name(): string
    {
        return 'ticktick_update_task';
    }

    public function description(): string
    {
        return 'Update an existing TickTick task. Requires both the task ID and its project ID. Only provided fields will be changed.';
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'string', 'required' => true, 'description' => 'The task ID to update.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project ID the task belongs to.'],
            'title' => ['type' => 'string', 'description' => 'New title for the task.'],
            'content' => ['type' => 'string', 'description' => 'New description/notes for the task.'],
            'start_date' => ['type' => 'string', 'description' => 'New start date in ISO 8601 format.'],
            'due_date' => ['type' => 'string', 'description' => 'New due date in ISO 8601 format.'],
            'priority' => ['type' => 'integer', 'description' => 'New priority: 0 = none, 1 = low, 3 = medium, 5 = high.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('TickTick integration is not configured.');
            }

            $data = [
                'id' => $args['task_id'],
                'projectId' => $args['project_id'],
            ];

            if (isset($args['title'])) {
                $data['title'] = $args['title'];
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

            $result = $this->service->updateTask($args['task_id'], $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
