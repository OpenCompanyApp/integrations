<?php

namespace OpenCompany\Integrations\GoToWebinar\Tools;

use OpenCompany\Integrations\GoToWebinar\GoToWebinarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoToWebinarGetCurrentUser implements Tool
{
    public function __construct(
        private GoToWebinarService $service,
    ) {}

    public function name(): string
    {
        return 'gotowebinar_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated GoTo Webinar user. Useful for verifying credentials and identifying the organizer account.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('GoTo Webinar integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
