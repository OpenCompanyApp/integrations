<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

use OpenCompany\Integrations\GoogleCalendar\GoogleCalendarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleCalendarCreateEvent implements Tool
{
    public function __construct(
        private GoogleCalendarService $service,
    ) {}

    public function name(): string
    {
        return 'gcalendar_create_event';
    }

    public function description(): string
    {
        return 'Create a new event on a Google Calendar. Requires at minimum a summary, start time, and end time. Supports adding attendees, location, and description.';
    }

    public function parameters(): array
    {
        return [
            'calendar_id' => ['type' => 'string', 'required' => true, 'description' => 'Calendar identifier (use "primary" for the user\'s main calendar).'],
            'summary' => ['type' => 'string', 'required' => true, 'description' => 'Title of the event (e.g., "Team Standup").'],
            'start' => ['type' => 'object', 'required' => true, 'description' => 'Start time of the event. An object with "dateTime" (RFC 3339) and "timeZone" (e.g., {"dateTime": "2026-04-06T10:00:00+02:00", "timeZone": "Europe/Amsterdam"}). For all-day events use "date" instead of "dateTime".'],
            'end' => ['type' => 'object', 'required' => true, 'description' => 'End time of the event. Same format as start. Must be after the start time.'],
            'description' => ['type' => 'string', 'description' => 'Description or notes for the event. Can contain HTML.'],
            'attendees' => ['type' => 'array', 'description' => 'List of attendee email objects, e.g., [{"email": "user@example.com"}].'],
            'location' => ['type' => 'string', 'description' => 'Location of the event (e.g., "Conference Room A" or a video call URL).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Calendar integration is not configured.');
            }

            $event = [
                'summary' => $args['summary'],
                'start' => $args['start'],
                'end' => $args['end'],
            ];

            if (isset($args['description'])) {
                $event['description'] = $args['description'];
            }

            if (isset($args['attendees'])) {
                $event['attendees'] = $args['attendees'];
            }

            if (isset($args['location'])) {
                $event['location'] = $args['location'];
            }

            $result = $this->service->createEvent($args['calendar_id'], $event);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
