<?php

namespace OpenCompany\Integrations\Accelo\Tools;

use OpenCompany\Integrations\Accelo\AcceloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: accelo_list_tasks
 *
 * Lists tasks from Accelo with optional filtering by status
 * and pagination support via limit/page parameters.
 */
class AcceloListTasks implements Tool
{
    public function __construct(
        private AcceloService $service,
    ) {}

    public function name(): string
    {
        return 'accelo_list_tasks';
    }

    public function description(): string
    {
        return 'List tasks in Accelo. Returns a paginated list of tasks, optionally filtered by status.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of tasks to return per page (default: 25, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based).'],
            'status' => ['type' => 'string', 'description' => 'Filter tasks by status (e.g. "open", "completed", "in_progress").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Accelo integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $status = $args['status'] ?? null;

            $result = $this->service->listTasks($limit, $page, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
