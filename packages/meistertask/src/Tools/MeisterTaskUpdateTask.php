<?php

namespace OpenCompany\Integrations\MeisterTask\Tools;

use OpenCompany\Integrations\MeisterTask\MeisterTaskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MeisterTaskUpdateTask implements Tool
{
    public function __construct(
        private MeisterTaskService $service,
    ) {}

    public function name(): string
    {
        return 'meistertask_update_task';
    }

    public function description(): string
    {
        return 'Update an existing MeisterTask task. You can change the name, status, description, assignee, due date, priority, labels, and more.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The task ID to update.'],
            'name' => ['type' => 'string', 'description' => 'New task name / title.'],
            'status' => ['type' => 'string', 'description' => 'New status. Common values: "open", "completed".'],
            'description' => ['type' => 'string', 'description' => 'Updated task description (supports Markdown).'],
            'assignee_id' => ['type' => 'integer', 'description' => 'User ID to reassign the task to.'],
            'due_date' => ['type' => 'string', 'description' => 'Updated due date in ISO 8601 format (e.g., "2026-04-30").'],
            'priority' => ['type' => 'integer', 'description' => 'Updated priority level.'],
            'section_id' => ['type' => 'integer', 'description' => 'Move the task to a different section (column).'],
            'labels' => ['type' => 'array', 'description' => 'Updated array of label names or IDs.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MeisterTask integration is not configured.');
            }

            $taskId = (int) $args['id'];
            $data = array_filter([
                'name' => $args['name'] ?? null,
                'status' => $args['status'] ?? null,
                'description' => $args['description'] ?? null,
                'assignee_id' => isset($args['assignee_id']) ? (int) $args['assignee_id'] : null,
                'due_date' => $args['due_date'] ?? null,
                'priority' => isset($args['priority']) ? (int) $args['priority'] : null,
                'section_id' => isset($args['section_id']) ? (int) $args['section_id'] : null,
                'labels' => $args['labels'] ?? null,
            ], fn ($value) => $value !== null);

            if (empty($data)) {
                return ToolResult::error('No fields provided to update. Provide at least one field besides "id".');
            }

            $result = $this->service->updateTask($taskId, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
