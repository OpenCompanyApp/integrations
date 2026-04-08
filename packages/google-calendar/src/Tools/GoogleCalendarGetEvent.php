<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

use OpenCompany\Integrations\GoogleCalendar\GoogleCalendarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleCalendarGetEvent implements Tool
{
    public function __construct(
        private GoogleCalendarService $service,
    ) {}

    public function name(): string
    {
        return 'gcalendar_get_event';
    }

    public function description(): string
    {
        return 'Get details of a specific event on a Google Calendar. Returns the full event resource including summary, description, attendees, and timing.';
    }

    public function parameters(): array
    {
        return [
            'calendar_id' => ['type' => 'string', 'required' => true, 'description' => 'Calendar identifier (use "primary" for the user\'s main calendar).'],
            'event_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the event.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Calendar integration is not configured.');
            }

            $result = $this->service->getEvent($args['calendar_id'], $args['event_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
