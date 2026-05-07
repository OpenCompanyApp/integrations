<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

use OpenCompany\Integrations\AcuityScheduling\AcuitySchedulingService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List appointments from Acuity Scheduling.
 */
class AcuityListAppointments implements Tool
{
    /**
     * @param  AcuitySchedulingService  $service  Acuity Scheduling API client.
     */
    public function __construct(
        private AcuitySchedulingService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'acuity_list_appointments';
    }

    /**
     * A description of what the tool does, used by AI agents for tool selection.
     */
    public function description(): string
    {
        return 'List appointments from Acuity Scheduling. Returns upcoming and past appointments with client details, date/time, and status. Use filters to narrow results by date range, calendar, or appointment type.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'minDate' => ['type' => 'string', 'description' => 'Earliest appointment date to return (ISO 8601, e.g., "2026-01-01").'],
            'maxDate' => ['type' => 'string', 'description' => 'Latest appointment date to return (ISO 8601, e.g., "2026-12-31").'],
            'calendarID' => ['type' => 'integer', 'description' => 'Filter by calendar ID.'],
            'appointmentTypeID' => ['type' => 'integer', 'description' => 'Filter by appointment type ID.'],
            'max' => ['type' => 'integer', 'description' => 'Maximum number of appointments to return (default: 100).'],
            'direction' => ['type' => 'string', 'description' => 'Sort direction: "asc" (oldest first) or "desc" (newest first). Default: "desc".'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Acuity Scheduling integration is not configured.');
            }

            $params = [];
            $filters = ['minDate', 'maxDate', 'calendarID', 'appointmentTypeID', 'max', 'direction'];

            foreach ($filters as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->listAppointments($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
