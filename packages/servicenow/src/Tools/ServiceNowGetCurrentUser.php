<?php

namespace OpenCompany\Integrations\ServiceNow\Tools;

use OpenCompany\Integrations\ServiceNow\ServiceNowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get the currently authenticated ServiceNow user's profile.
 *
 * Calls the /user_profile endpoint which returns the profile of the
 * user whose credentials are configured for this integration.
 */
class ServiceNowGetCurrentUser implements Tool
{
    public function __construct(
        private ServiceNowService $service,
    ) {}

    public function name(): string
    {
        return 'servicenow_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated ServiceNow user. Useful for verifying credentials and retrieving the logged-in user\'s details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ServiceNow integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
