<?php

namespace OpenCompany\Integrations\AddEvent\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\AddEvent\AddEventService;

/**
 * Create an AddEvent calendar.
 *
 * Creates a calendar container for events.
 */
class AddEventCreateCalendar implements Tool
{
    /**
     * @param  AddEventService  $service  The AddEvent API client.
     */
    public function __construct(
        private AddEventService $service,
    ) {}

    public function name(): string
    {
        return 'addevent_create_calendar';
    }

    public function description(): string
    {
        return 'Create a new AddEvent calendar. Requires title; optional fields include timezone, weekday_begin, description, internal_name, calendar_color, and custom_data.';
    }

    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'Calendar title.'],
            'timezone' => ['type' => 'string', 'description' => 'Default calendar timezone.'],
            'weekday_begin' => ['type' => 'string', 'enum' => ['sunday', 'monday'], 'description' => 'Calendar week start day.'],
            'description' => ['type' => 'string', 'description' => 'Calendar description.'],
            'internal_name' => ['type' => 'string', 'description' => 'Internal calendar name.'],
            'calendar_color' => ['type' => 'integer', 'description' => 'Calendar color ID from 1 to 20.'],
            'custom_data' => ['type' => 'object', 'description' => 'Custom key/value data to attach to the calendar.'],
        ];
    }

    /**
     * Create an AddEvent calendar.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('AddEvent integration is not configured.');
            }
            if (empty($args['title'])) {
                return ToolResult::error('Calendar title is required.');
            }

            return ToolResult::success($this->service->createCalendar($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
