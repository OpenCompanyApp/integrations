<?php

namespace OpenCompany\Integrations\AddEvent\Tools;

use OpenCompany\Integrations\AddEvent\AddEventService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated AddEvent user profile.
 *
 * Returns information about the authenticated user, useful for verifying
 * credentials and displaying account details.
 */
class AddEventGetCurrentUser implements Tool
{
    public function __construct(
        private AddEventService $service,
    ) {}

    public function name(): string
    {
        return 'addevent_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated AddEvent user. Useful for verifying credentials and displaying account information.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('AddEvent integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
