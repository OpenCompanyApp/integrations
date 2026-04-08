<?php

namespace OpenCompany\Integrations\ServiceM8\Tools;

use OpenCompany\Integrations\ServiceM8\ServiceM8Service;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated ServiceM8 user.
 *
 * Returns the user profile of the authenticated account, useful for
 * identifying which ServiceM8 account is connected.
 */
class ServiceM8GetCurrentUser implements Tool
{
    public function __construct(
        private ServiceM8Service $service,
    ) {}

    public function name(): string
    {
        return 'servicem8_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated ServiceM8 user. Returns name, email, role, and account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ServiceM8 integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
