<?php

namespace OpenCompany\Integrations\Motion\Tools;

use OpenCompany\Integrations\Motion\MotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MotionListTasks implements Tool
{
    public function __construct(
        private MotionService $service,
    ) {}

    public function name(): string
    {
        return 'motion_list_tasks';
    }

    public function description(): string
    {
        return 'List tasks from Motion with optional filters. Filter by status, project, or assignee. Supports cursor-based pagination.';
    }

    public function parameters(): array
    {
        return [
            'status' => ['type' => 'string', 'description' => 'Filter by task status. Common values: "Todo", "In Progress", "Done".'],
            'projectId' => ['type' => 'string', 'description' => 'Filter tasks by project ID.'],
            'assigneeId' => ['type' => 'string', 'description' => 'Filter tasks by assignee user ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of tasks to return per page (default: 20, max: 100).'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response to fetch the next page.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Motion integration is not configured.');
            }

            $params = [];

            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['projectId'])) {
                $params['projectId'] = $args['projectId'];
            }
            if (isset($args['assigneeId'])) {
                $params['assigneeId'] = $args['assigneeId'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['cursor'])) {
                $params['cursor'] = $args['cursor'];
            }

            $result = $this->service->listTasks($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
