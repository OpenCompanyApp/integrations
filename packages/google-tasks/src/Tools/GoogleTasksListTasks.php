<?php

namespace OpenCompany\Integrations\GoogleTasks\Tools;

use OpenCompany\Integrations\GoogleTasks\GoogleTasksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleTasksListTasks implements Tool
{
    public function __construct(
        private GoogleTasksService $service,
    ) {}

    public function name(): string
    {
        return 'gtasks_list_tasks';
    }

    public function description(): string
    {
        return 'List tasks in a specific task list in Google Tasks. Returns task titles, IDs, status, due dates, and notes. Use "list_task_lists" first to find the task list ID.';
    }

    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'The task list ID (use "list_task_lists" to find IDs). Use "@" for the default list.'],
            'maxResults' => ['type' => 'integer', 'description' => 'Maximum number of tasks to return per page (default: 20, max: 100).'],
            'pageToken' => ['type' => 'string', 'description' => 'Token for the next page of results from a previous list call.'],
            'showCompleted' => ['type' => 'boolean', 'description' => 'Whether to include completed tasks (default: true).'],
            'dueDate' => ['type' => 'string', 'description' => 'ISO 8601 timestamp to filter tasks due before this date (e.g., "2026-04-30T00:00:00.000Z").'],
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

            $result = $this->service->listTasks(
                taskListId: $args['list_id'],
                maxResults: isset($args['maxResults']) ? (int) $args['maxResults'] : null,
                pageToken: $args['pageToken'] ?? null,
                showCompleted: isset($args['showCompleted']) ? (bool) $args['showCompleted'] : null,
                dueDate: $args['dueDate'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
