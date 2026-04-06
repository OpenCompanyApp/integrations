<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\Integrations\Capsule\CapsuleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * CapsuleListTasks — list tasks from Capsule CRM.
 *
 * Supports pagination via `page` and `per_page` parameters,
 * and optional filtering by status (e.g. "OPEN", "COMPLETED").
 */
class CapsuleListTasks implements Tool
{
    public function __construct(
        private CapsuleService $service,
    ) {}

    public function name(): string
    {
        return 'capsule_list_tasks';
    }

    public function description(): string
    {
        return 'List tasks from Capsule CRM. Optionally filter by status (OPEN, COMPLETED). Returns paginated results.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of tasks per page, max 100 (default: 50).'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: OPEN or COMPLETED.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Capsule CRM integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 50;
            $status = $args['status'] ?? null;

            $result = $this->service->listTasks($page, $perPage, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
