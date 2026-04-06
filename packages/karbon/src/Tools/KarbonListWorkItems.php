<?php

namespace OpenCompany\Integrations\Karbon\Tools;

use OpenCompany\Integrations\Karbon\KarbonService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KarbonListWorkItems implements Tool
{
    public function __construct(
        private KarbonService $service,
    ) {}

    public function name(): string
    {
        return 'karbon_list_work_items';
    }

    public function description(): string
    {
        return 'List work items in Karbon. Returns a paginated list of work items. Optionally filter by status (e.g., "Open", "InProgress", "Completed") or by assignee.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of work items to return per page (default: 20, max: 100).'],
            'status' => ['type' => 'string', 'description' => 'Filter by work item status (e.g., "Open", "InProgress", "Completed").'],
            'assignee' => ['type' => 'string', 'description' => 'Filter by the email or ID of the assigned user.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Karbon integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $status = $args['status'] ?? null;
            $assignee = $args['assignee'] ?? null;

            $result = $this->service->listWorkItems($page, $limit, $status, $assignee);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
