<?php

namespace OpenCompany\Integrations\Todoist\Tools;

use OpenCompany\Integrations\Core\Contracts\Tool;
use OpenCompany\Integrations\Core\Support\ToolResult;
use OpenCompany\Integrations\Todoist\TodoistService;

/**
 * Update an existing Todoist task's properties.
 */
class TodoistUpdateTask implements Tool
{
    /**
     * @param TodoistService $service The Todoist API service instance.
     */
    public function __construct(
        private TodoistService $service,
    ) {}

    public function name(): string
    {
        return 'todoist_update_task';
    }

    public function description(): string
    {
        return 'Update an existing task in Todoist. Only the fields provided will be changed.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique ID of the task to update.'],
            'content' => ['type' => 'string', 'required' => false, 'description' => 'New task content/title.'],
            'description' => ['type' => 'string', 'required' => false, 'description' => 'New task description.'],
            'labels' => ['type' => 'array', 'required' => false, 'description' => 'List of label names to assign.', 'items' => ['type' => 'string']],
            'priority' => ['type' => 'integer', 'required' => false, 'description' => 'Task priority: 1=normal, 2=medium, 3=high, 4=urgent.'],
            'due_date' => ['type' => 'string', 'required' => false, 'description' => 'Due date in YYYY-MM-DD format.'],
        ];
    }

    /**
     * Update an existing Todoist task.
     *
     * @param array<string, mixed> $args Must contain 'id'; other fields are optional updates.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Todoist integration is not configured.');
            }

            $id = $args['id'];
            unset($args['id']);

            $result = $this->service->updateTask($id, $args);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
