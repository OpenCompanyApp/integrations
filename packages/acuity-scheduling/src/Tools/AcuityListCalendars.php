<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

use OpenCompany\Integrations\AcuityScheduling\AcuitySchedulingService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List calendars from Acuity Scheduling.
 */
class AcuityListCalendars implements Tool
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
        return 'acuity_list_calendars';
    }

    /**
     * A description of what the tool does, used by AI agents for tool selection.
     */
    public function description(): string
    {
        return 'List all calendars in Acuity Scheduling. Returns calendar IDs, names, and timezone info. Use calendar IDs to filter appointments.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
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

            $result = $this->service->listCalendars();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
