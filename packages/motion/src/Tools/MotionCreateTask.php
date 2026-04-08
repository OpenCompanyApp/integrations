<?php

namespace OpenCompany\Integrations\Motion\Tools;

use OpenCompany\Integrations\Motion\MotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MotionCreateTask implements Tool
{
    public function __construct(
        private MotionService $service,
    ) {}

    public function name(): string
    {
        return 'motion_create_task';
    }

    public function description(): string
    {
        return 'Create a new task in Motion. Requires a task name. Optionally specify a project, assignee, due date, priority, and description. Motion will auto-schedule the task based on priorities and deadlines.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The title/name of the task.'],
            'projectId' => ['type' => 'string', 'description' => 'The ID of the project to add the task to.'],
            'assigneeId' => ['type' => 'string', 'description' => 'The user ID of the person to assign the task to.'],
            'dueDate' => ['type' => 'string', 'description' => 'Due date in ISO 8601 format (e.g., "2025-12-31"). Motion uses this for auto-scheduling.'],
            'priority' => ['type' => 'string', 'description' => 'Task priority: "ASAP", "HIGH", "MEDIUM", or "LOW". Defaults to "MEDIUM".'],
            'description' => ['type' => 'string', 'description' => 'Detailed description of the task. Supports Markdown.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Motion integration is not configured.');
            }

            $data = [
                'name' => $args['name'],
            ];

            if (isset($args['projectId'])) {
                $data['projectId'] = $args['projectId'];
            }
            if (isset($args['assigneeId'])) {
                $data['assigneeId'] = $args['assigneeId'];
            }
            if (isset($args['dueDate'])) {
                $data['dueDate'] = $args['dueDate'];
            }
            if (isset($args['priority'])) {
                $data['priority'] = $args['priority'];
            }
            if (isset($args['description'])) {
                $data['description'] = $args['description'];
            }

            $result = $this->service->createTask($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
