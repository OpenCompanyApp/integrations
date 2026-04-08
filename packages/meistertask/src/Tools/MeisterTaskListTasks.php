<?php

namespace OpenCompany\Integrations\MeisterTask\Tools;

use OpenCompany\Integrations\MeisterTask\MeisterTaskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MeisterTaskListTasks implements Tool
{
    public function __construct(
        private MeisterTaskService $service,
    ) {}

    public function name(): string
    {
        return 'meistertask_list_tasks';
    }

    public function description(): string
    {
        return 'List tasks across MeisterTask projects with optional filters. Supports filtering by project, status, assignee, and more.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'integer', 'description' => 'Filter tasks by project ID.'],
            'status' => ['type' => 'string', 'description' => 'Filter by status. Common values: "open", "completed".'],
            'assignee_id' => ['type' => 'integer', 'description' => 'Filter by assignee user ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of tasks to return.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MeisterTask integration is not configured.');
            }

            $params = array_filter([
                'project_id' => isset($args['project_id']) ? (int) $args['project_id'] : null,
                'status' => $args['status'] ?? null,
                'assignee_id' => isset($args['assignee_id']) ? (int) $args['assignee_id'] : null,
                'limit' => isset($args['limit']) ? (int) $args['limit'] : null,
                'page' => isset($args['page']) ? (int) $args['page'] : null,
            ], fn ($value) => $value !== null);

            $result = $this->service->listTasks($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
