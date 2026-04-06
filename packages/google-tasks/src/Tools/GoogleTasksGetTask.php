<?php

namespace OpenCompany\Integrations\GoogleTasks\Tools;

use OpenCompany\Integrations\GoogleTasks\GoogleTasksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleTasksGetTask implements Tool
{
    public function __construct(
        private GoogleTasksService $service,
    ) {}

    public function name(): string
    {
        return 'gtasks_get_task';
    }

    public function description(): string
    {
        return 'Get a specific task by its ID from a task list in Google Tasks. Returns the task title, notes, due date, status, and other details.';
    }

    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'The task list ID (use "list_task_lists" to find IDs).'],
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The task ID (use "list_tasks" to find task IDs).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Tasks integration is not configured.');
            }

            if (empty($args['list_id']) || empty($args['id'])) {
                return ToolResult::error('Both "list_id" and "id" parameters are required.');
            }

            $result = $this->service->getTask($args['list_id'], $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
