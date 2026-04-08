<?php

namespace OpenCompany\Integrations\Nifty\Tools;

use OpenCompany\Integrations\Nifty\NiftyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NiftyListTasks implements Tool
{
    public function __construct(
        private NiftyService $service,
    ) {}

    public function name(): string
    {
        return 'nifty_list_tasks';
    }

    public function description(): string
    {
        return 'List tasks in Nifty with optional filters. Filter by project, status, assignee, or other criteria. Returns task IDs, titles, statuses, and assignees.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'description' => 'Filter tasks by project ID.'],
            'status' => ['type' => 'string', 'description' => 'Filter by task status (e.g., "open", "in_progress", "completed").'],
            'assignee_id' => ['type' => 'string', 'description' => 'Filter by assignee user ID.'],
            'milestone_id' => ['type' => 'string', 'description' => 'Filter by milestone ID.'],
            'task_list_id' => ['type' => 'string', 'description' => 'Filter by task list ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of tasks to return.'],
            'offset' => ['type' => 'integer', 'description' => 'Number of tasks to skip for pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Nifty integration is not configured.');
            }

            $params = [];

            // Forward supported filter params
            foreach (['project_id', 'status', 'assignee_id', 'milestone_id', 'task_list_id', 'limit', 'offset'] as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->listTasks($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
