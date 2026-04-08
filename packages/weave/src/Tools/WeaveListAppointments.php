<?php

namespace OpenCompany\Integrations\Weave\Tools;

use OpenCompany\Integrations\Weave\WeaveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List appointments from the Weave platform.
 *
 * Supports date range filtering and result limiting. Returns
 * appointment records including patient references, scheduled times,
 * durations, and status information.
 */
class WeaveListAppointments implements Tool
{
    public function __construct(
        private WeaveService $service,
    ) {}

    public function name(): string
    {
        return 'weave_list_appointments';
    }

    public function description(): string
    {
        return 'List appointments from Weave with optional date range filtering. Returns appointment records with patient info, scheduled times, and status.';
    }

    public function parameters(): array
    {
        return [
            'startDate' => ['type' => 'string', 'description' => 'Start date for the range (ISO 8601, e.g. "2025-01-01").'],
            'endDate' => ['type' => 'string', 'description' => 'End date for the range (ISO 8601, e.g. "2025-01-31").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of appointments to return (default: 25).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Weave integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $startDate = $args['startDate'] ?? null;
            $endDate = $args['endDate'] ?? null;

            $result = $this->service->listAppointments($startDate, $endDate, $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
