<?php

namespace OpenCompany\Integrations\BambooHR\Tools;

use OpenCompany\Integrations\BambooHR\BambooHRService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BambooHRListTimeOffRequests implements Tool
{
    public function __construct(
        private BambooHRService $service,
    ) {}

    public function name(): string
    {
        return 'bamboohr_list_time_off_requests';
    }

    public function description(): string
    {
        return 'List time-off requests from BambooHR. Optionally filter by date range, status, or employee ID.';
    }

    public function parameters(): array
    {
        return [
            'start' => ['type' => 'string', 'description' => 'Start date for filtering requests (YYYY-MM-DD).'],
            'end' => ['type' => 'string', 'description' => 'End date for filtering requests (YYYY-MM-DD).'],
            'status' => ['type' => 'string', 'description' => 'Filter by status (e.g., "approved", "pending", "denied").'],
            'employee_id' => ['type' => 'integer', 'description' => 'Filter by employee ID.'],
            'type_id' => ['type' => 'integer', 'description' => 'Filter by time-off type ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('BambooHR integration is not configured.');
            }

            $filters = [];

            if (isset($args['start'])) {
                $filters['start'] = $args['start'];
            }
            if (isset($args['end'])) {
                $filters['end'] = $args['end'];
            }
            if (isset($args['status'])) {
                $filters['status'] = $args['status'];
            }
            if (isset($args['employee_id'])) {
                $filters['employeeId'] = $args['employee_id'];
            }
            if (isset($args['type_id'])) {
                $filters['typeId'] = $args['type_id'];
            }

            $result = $this->service->listTimeOffRequests($filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
