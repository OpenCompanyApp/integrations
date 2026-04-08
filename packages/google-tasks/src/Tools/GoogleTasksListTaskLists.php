<?php

namespace OpenCompany\Integrations\GoogleTasks\Tools;

use OpenCompany\Integrations\GoogleTasks\GoogleTasksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleTasksListTaskLists implements Tool
{
    public function __construct(
        private GoogleTasksService $service,
    ) {}

    public function name(): string
    {
        return 'gtasks_list_task_lists';
    }

    public function description(): string
    {
        return 'List all task lists for the authenticated user in Google Tasks. Returns task list IDs and titles that can be used to manage tasks within each list.';
    }

    public function parameters(): array
    {
        return [
            'maxResults' => ['type' => 'integer', 'description' => 'Maximum number of task lists to return per page (default: 20, max: 100).'],
            'pageToken' => ['type' => 'string', 'description' => 'Token for the next page of results from a previous list call.'],
            'showCompleted' => ['type' => 'boolean', 'description' => 'Whether to show completed tasks in the response (default: true).'],
            'showHidden' => ['type' => 'boolean', 'description' => 'Whether to show hidden task lists (default: false).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Tasks integration is not configured.');
            }

            $result = $this->service->listTaskLists(
                maxResults: isset($args['maxResults']) ? (int) $args['maxResults'] : null,
                pageToken: $args['pageToken'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
