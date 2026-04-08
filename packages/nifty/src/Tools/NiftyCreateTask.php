<?php

namespace OpenCompany\Integrations\Nifty\Tools;

use OpenCompany\Integrations\Nifty\NiftyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NiftyCreateTask implements Tool
{
    public function __construct(
        private NiftyService $service,
    ) {}

    public function name(): string
    {
        return 'nifty_create_task';
    }

    public function description(): string
    {
        return 'Create a new task in a Nifty project. Requires a title and project ID. Optionally include a description, task list, assignee, and due date.';
    }

    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title of the task.'],
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the project to create the task in.'],
            'description' => ['type' => 'string', 'description' => 'A detailed description of the task (supports markdown).'],
            'task_list_id' => ['type' => 'string', 'description' => 'The ID of the task list to add the task to.'],
            'assignee_id' => ['type' => 'string', 'description' => 'The user ID of the person to assign the task to.'],
            'due_date' => ['type' => 'string', 'description' => 'Due date for the task (ISO 8601 format, e.g., "2025-12-31").'],
            'priority' => ['type' => 'string', 'description' => 'Task priority level (e.g., "low", "medium", "high", "urgent").'],
            'labels' => ['type' => 'array', 'description' => 'Array of label names to apply to the task.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Nifty integration is not configured.');
            }

            if (empty($args['title'])) {
                return ToolResult::error('title is required.');
            }

            if (empty($args['project_id'])) {
                return ToolResult::error('project_id is required.');
            }

            $data = [
                'title' => $args['title'],
                'project_id' => $args['project_id'],
            ];

            // Forward optional fields
            foreach (['description', 'task_list_id', 'assignee_id', 'due_date', 'priority', 'labels'] as $key) {
                if (isset($args[$key])) {
                    $data[$key] = $args[$key];
                }
            }

            $result = $this->service->createTask($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
