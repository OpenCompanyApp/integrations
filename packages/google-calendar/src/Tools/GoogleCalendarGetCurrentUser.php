<?php

namespace OpenCompany\Integrations\GoogleCalendar\Tools;

use OpenCompany\Integrations\GoogleCalendar\GoogleCalendarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleCalendarGetCurrentUser implements Tool
{
    public function __construct(
        private GoogleCalendarService $service,
    ) {}

    public function name(): string
    {
        return 'gcalendar_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Google user\'s profile information, including name, email, and profile picture. Useful for verifying the connected account.';
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

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
