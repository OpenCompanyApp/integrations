<?php

namespace OpenCompany\Integrations\AddEvent\Tools;

use OpenCompany\Integrations\AddEvent\AddEventService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new calendar event in AddEvent.
 *
 * Creates an event with v2 Calendar and Events API fields.
 */
class AddEventCreateEvent implements Tool
{
    /**
     * @param  AddEventService  $service  The AddEvent API client.
     */
    public function __construct(
        private AddEventService $service,
    ) {}

    public function name(): string
    {
        return 'addevent_create_event';
    }

    public function description(): string
    {
        return 'Create a new calendar event in AddEvent. Requires title and datetime_start. Optionally set calendar_id, datetime_end, timezone, location, description, RSVP, color, and custom data.';
    }

    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'Event title.'],
            'datetime_start' => ['type' => 'string', 'required' => true, 'description' => 'Event start date/time, e.g. "2026-04-10 09:00:00".'],
            'datetime_end' => ['type' => 'string', 'description' => 'Event end date/time. Defaults to one hour after datetime_start when omitted by AddEvent.'],
            'calendar_id' => ['type' => 'string', 'description' => 'Calendar ID. Defaults to the account default calendar when omitted.'],
            'timezone' => ['type' => 'string', 'description' => 'Event timezone, e.g. "America/New_York" or "floating".'],
            'all_day_event' => ['type' => 'boolean', 'description' => 'Whether this is an all-day event.'],
            'location' => ['type' => 'string', 'description' => 'Event location or meeting URL.'],
            'description' => ['type' => 'string', 'description' => 'Event description. Plain text and simplified HTML are supported by AddEvent.'],
            'organizer_name' => ['type' => 'string', 'description' => 'Organizer name. Requires organizer_email when provided.'],
            'organizer_email' => ['type' => 'string', 'description' => 'Organizer email. Requires organizer_name when provided.'],
            'color' => ['type' => 'integer', 'description' => 'Event color ID from 1 to 20.'],
            'rsvp_enabled' => ['type' => 'boolean', 'description' => 'Whether RSVP is enabled for the event.'],
            'custom_data' => ['type' => 'object', 'description' => 'Custom key/value data to attach to the event.'],
        ];
    }

    /**
     * Create an AddEvent event.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('AddEvent integration is not configured.');
            }

            if (empty($args['title'])) {
                return ToolResult::error('Event title is required.');
            }
            if (empty($args['datetime_start'])) {
                return ToolResult::error('Event datetime_start is required.');
            }

            $attributes = $args;
            unset($attributes['start_date'], $attributes['end_date'], $attributes['category_id']);
            $result = $this->service->createEvent($attributes);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
