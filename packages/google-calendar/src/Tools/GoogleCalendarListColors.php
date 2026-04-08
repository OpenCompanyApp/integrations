<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

use OpenCompany\Integrations\GoogleCalendar\GoogleCalendarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleCalendarListColors implements Tool
{
    public function __construct(
        private GoogleCalendarService $service,
    ) {}

    public function name(): string
    {
        return 'gcalendar_list_colors';
    }

    public function description(): string
    {
        return 'Get the available color definitions for Google Calendar events and calendars. Returns color palettes that can be used when creating or updating events and calendars.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Calendar integration is not configured.');
            }

            $result = $this->service->listColors();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
