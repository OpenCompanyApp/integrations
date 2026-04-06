<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

use OpenCompany\Integrations\GoogleCalendar\GoogleCalendarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleCalendarListCalendars implements Tool
{
    public function __construct(
        private GoogleCalendarService $service,
    ) {}

    public function name(): string
    {
        return 'gcalendar_list_calendars';
    }

    public function description(): string
    {
        return 'List all calendars on the user\'s Google Calendar account. Returns calendar IDs, summaries, and metadata for each calendar.';
    }

    public function parameters(): array
    {
        return [
            'maxResults' => ['type' => 'integer', 'description' => 'Maximum number of calendars to return (default: 250, max: 2500).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Calendar integration is not configured.');
            }

            $params = [];
            if (isset($args['maxResults'])) {
                $params['maxResults'] = $args['maxResults'];
            }

            $result = $this->service->listCalendars($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
