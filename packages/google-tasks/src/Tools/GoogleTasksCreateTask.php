<?php

namespace OpenCompany\Integrations\GoogleTasks\Tools;

use OpenCompany\Integrations\GoogleTasks\GoogleTasksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleTasksCreateTask implements Tool
{
    public function __construct(
        private GoogleTasksService $service,
    ) {}

    public function name(): string
    {
        return 'gtasks_create_task';
    }

    public function description(): string
    {
        return 'Create a new task in a Google Tasks list. Provide a title, and optionally notes and a due date.';
    }

    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'The task list ID (use "list_task_lists" to find IDs). Use "@" for the default list.'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title of the task (e.g., "Buy groceries").'],
            'notes' => ['type' => 'string', 'description' => 'Notes or description for the task.'],
            'due' => ['type' => 'string', 'description' => 'Due date in RFC 3339 format (e.g., "2026-04-30T00:00:00.000Z").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Tasks integration is not configured.');
            }

            if (empty($args['list_id'])) {
                return ToolResult::error('The "list_id" parameter is required.');
            }

            if (empty($args['title'])) {
                return ToolResult::error('The "title" parameter is required.');
            }

            $result = $this->service->createTask(
                taskListId: $args['list_id'],
                title: $args['title'],
                notes: $args['notes'] ?? null,
                due: $args['due'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
