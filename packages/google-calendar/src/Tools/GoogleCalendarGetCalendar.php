<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

use OpenCompany\Integrations\GoogleCalendar\GoogleCalendarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleCalendarGetCalendar implements Tool
{
    public function __construct(
        private GoogleCalendarService $service,
    ) {}

    public function name(): string
    {
        return 'gcalendar_get_calendar';
    }

    public function description(): string
    {
        return 'Get details of a specific Google Calendar by its ID. Returns the calendar resource including summary, description, time zone, and access settings.';
    }

    public function parameters(): array
    {
        return [
            'calendar_id' => ['type' => 'string', 'required' => true, 'description' => 'Calendar identifier (use "primary" for the user\'s main calendar, or a specific calendar email/ID).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Calendar integration is not configured.');
            }

            $result = $this->service->getCalendar($args['calendar_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
