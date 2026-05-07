<?php

namespace OpenCompany\Integrations\AddEvent\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\AddEvent\AddEventService;

/**
 * List AddEvent supported timezones.
 *
 * Helps agents choose valid timezone values for events and calendars.
 */
class AddEventListTimezones implements Tool
{
    /**
     * @param  AddEventService  $service  The AddEvent API client.
     */
    public function __construct(
        private AddEventService $service,
    ) {}

    public function name(): string
    {
        return 'addevent_list_timezones';
    }

    public function description(): string
    {
        return 'List timezones supported by the AddEvent Calendar and Events API.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List AddEvent timezones.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('AddEvent integration is not configured.');
            }

            return ToolResult::success($this->service->listTimezones());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
