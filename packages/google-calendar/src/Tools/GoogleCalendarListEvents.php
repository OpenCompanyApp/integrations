<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

use OpenCompany\Integrations\GoogleCalendar\GoogleCalendarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleCalendarListEvents implements Tool
{
    public function __construct(
        private GoogleCalendarService $service,
    ) {}

    public function name(): string
    {
        return 'gcalendar_list_events';
    }

    public function description(): string
    {
        return 'List events on a Google Calendar. Returns events within a specified time range. Use "primary" as the calendar ID for the user\'s main calendar.';
    }

    public function parameters(): array
    {
        return [
            'calendar_id' => ['type' => 'string', 'required' => true, 'description' => 'Calendar identifier (use "primary" for the user\'s main calendar, or a specific calendar ID).'],
            'timeMin' => ['type' => 'string', 'description' => 'Lower bound (exclusive) for event start time, as an RFC 3339 timestamp (e.g., "2026-04-06T00:00:00Z").'],
            'timeMax' => ['type' => 'string', 'description' => 'Upper bound (exclusive) for event end time, as an RFC 3339 timestamp (e.g., "2026-04-13T00:00:00Z").'],
            'maxResults' => ['type' => 'integer', 'description' => 'Maximum number of events to return (default: 250, max: 2500).'],
            'q' => ['type' => 'string', 'description' => 'Free text search to find events matching the query string.'],
            'orderBy' => ['type' => 'string', 'description' => 'Sort order: "startTime" (requires timeMin/timeMax) or "updated".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Calendar integration is not configured.');
            }

            $params = [];
            $optionalParams = ['timeMin', 'timeMax', 'maxResults', 'q', 'orderBy'];

            foreach ($optionalParams as $param) {
                if (isset($args[$param])) {
                    $params[$param] = $args[$param];
                }
            }

            $result = $this->service->listEvents($args['calendar_id'], $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
