<?php

namespace OpenCompany\Integrations\Motion\Tools;

use OpenCompany\Integrations\Motion\MotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MotionListSchedules implements Tool
{
    public function __construct(
        private MotionService $service,
    ) {}

    public function name(): string
    {
        return 'motion_list_schedules';
    }

    public function description(): string
    {
        return 'List schedules from Motion within a date range. Returns scheduled tasks and events for the authenticated user.';
    }

    public function parameters(): array
    {
        return [
            'startDate' => ['type' => 'string', 'required' => true, 'description' => 'Start date in ISO 8601 format (e.g., "2025-01-01").'],
            'endDate' => ['type' => 'string', 'required' => true, 'description' => 'End date in ISO 8601 format (e.g., "2025-01-31").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Motion integration is not configured.');
            }

            $params = [
                'startDate' => $args['startDate'],
                'endDate' => $args['endDate'],
            ];

            $result = $this->service->listSchedules($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
