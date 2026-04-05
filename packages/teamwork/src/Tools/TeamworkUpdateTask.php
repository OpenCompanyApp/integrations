<?php

namespace OpenCompany\Integrations\Teamwork\Tools;

use OpenCompany\Integrations\Teamwork\TeamworkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: teamwork_update_task
 *
 * Update an existing Teamwork task.
 */
class TeamworkUpdateTask implements Tool
{
    public function __construct(
        private TeamworkService $service,
    ) {}

    public function name(): string
    {
        return 'teamwork_update_task';
    }

    public function description(): string
    {
        return 'Update an existing task in Teamwork. Provide the task ID and the fields to change (name, description, dueDate, priority, assigneeIds, etc.).';
    }

    public function parameters(): array
    {
        return [
            'task_id'       => ['type' => 'integer', 'required' => true, 'description' => 'The task ID to update.'],
            'name'          => ['type' => 'string',  'description' => 'New task name.'],
            'description'   => ['type' => 'string',  'description' => 'Updated task description.'],
            'assigneeIds'   => ['type' => 'array',   'description' => 'Array of user IDs to assign.'],
            'dueDate'       => ['type' => 'string',  'description' => 'Due date in ISO 8601 format (e.g., "2026-04-30").'],
            'priority'      => ['type' => 'string',  'description' => 'Task priority: "low", "medium", "high".'],
            'estimatedTime' => ['type' => 'integer', 'description' => 'Estimated time in minutes.'],
            'progress'      => ['type' => 'integer', 'description' => 'Task progress percentage (0–100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Teamwork integration is not configured.');
            }

            $taskId = (int) $args['task_id'];

            $data = [];
            $fields = ['name', 'description', 'assigneeIds', 'dueDate', 'priority', 'estimatedTime', 'progress'];
            foreach ($fields as $field) {
                if (isset($args[$field])) {
                    $data[$field] = in_array($field, ['estimatedTime', 'progress'])
                        ? (int) $args[$field]
                        : $args[$field];
                }
            }

            $result = $this->service->updateTask($taskId, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
