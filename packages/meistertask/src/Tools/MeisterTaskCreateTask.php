<?php

namespace OpenCompany\Integrations\MeisterTask\Tools;

use OpenCompany\Integrations\MeisterTask\MeisterTaskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MeisterTaskCreateTask implements Tool
{
    public function __construct(
        private MeisterTaskService $service,
    ) {}

    public function name(): string
    {
        return 'meistertask_create_task';
    }

    public function description(): string
    {
        return 'Create a new task in a MeisterTask project. You must specify the project and at least a task name. Optionally set status, assignee, due date, description, and more.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'integer', 'required' => true, 'description' => 'The project ID to create the task in.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The task name / title.'],
            'status' => ['type' => 'string', 'description' => 'Task status. Common values: "open", "completed". Defaults to "open".'],
            'description' => ['type' => 'string', 'description' => 'A detailed description of the task (supports Markdown).'],
            'assignee_id' => ['type' => 'integer', 'description' => 'The user ID of the person to assign the task to.'],
            'due_date' => ['type' => 'string', 'description' => 'Due date in ISO 8601 format (e.g., "2026-04-30").'],
            'priority' => ['type' => 'integer', 'description' => 'Task priority level.'],
            'section_id' => ['type' => 'integer', 'description' => 'The section (column) ID within the project to place the task.'],
            'labels' => ['type' => 'array', 'description' => 'Array of label names or IDs to attach to the task.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MeisterTask integration is not configured.');
            }

            $projectId = (int) $args['project_id'];
            $data = array_filter([
                'name' => $args['name'],
                'status' => $args['status'] ?? null,
                'description' => $args['description'] ?? null,
                'assignee_id' => isset($args['assignee_id']) ? (int) $args['assignee_id'] : null,
                'due_date' => $args['due_date'] ?? null,
                'priority' => isset($args['priority']) ? (int) $args['priority'] : null,
                'section_id' => isset($args['section_id']) ? (int) $args['section_id'] : null,
                'labels' => $args['labels'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->createTask($projectId, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
