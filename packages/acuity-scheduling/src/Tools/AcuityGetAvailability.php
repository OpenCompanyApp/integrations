<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

use OpenCompany\Integrations\AcuityScheduling\AcuitySchedulingService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get available appointment times from Acuity Scheduling.
 */
class AcuityGetAvailability implements Tool
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
        return 'acuity_get_availability';
    }

    /**
     * A description of what the tool does, used by AI agents for tool selection.
     */
    public function description(): string
    {
        return 'Get available time slots for booking in Acuity Scheduling. Returns open times for a given appointment type, date, and optional calendar.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'appointmentTypeID' => ['type' => 'integer', 'required' => true, 'description' => 'The appointment type ID to check availability for.'],
            'date' => ['type' => 'string', 'required' => true, 'description' => 'The date to check availability for (YYYY-MM-DD format, e.g., "2026-04-10").'],
            'calendarID' => ['type' => 'integer', 'description' => 'Filter availability for a specific calendar.'],
            'timezone' => ['type' => 'string', 'description' => 'Timezone for the returned times (e.g., "America/New_York"). Defaults to the account timezone.'],
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

            if (!isset($args['appointmentTypeID'])) {
                return ToolResult::error('The "appointmentTypeID" parameter is required.');
            }

            if (!isset($args['date'])) {
                return ToolResult::error('The "date" parameter is required.');
            }

            $params = [
                'appointmentTypeID' => (int) $args['appointmentTypeID'],
                'date' => $args['date'],
            ];

            if (isset($args['calendarID'])) {
                $params['calendarID'] = (int) $args['calendarID'];
            }

            if (isset($args['timezone'])) {
                $params['timezone'] = $args['timezone'];
            }

            $result = $this->service->getAvailability($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
