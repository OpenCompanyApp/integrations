<?php

namespace OpenCompany\Integrations\Clockify\Tools;

use OpenCompany\Integrations\Clockify\ClockifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: clockify_get_current_user
 *
 * Gets the authenticated Clockify user profile. Useful for verifying API key validity.
 */
class ClockifyGetCurrentUser implements Tool
{
    public function __construct(
        private ClockifyService $service,
    ) {}

    public function name(): string
    {
        return 'clockify_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Clockify user profile. Use this to verify your API key is working.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Clockify integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
