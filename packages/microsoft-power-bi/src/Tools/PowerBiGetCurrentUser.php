<?php

namespace OpenCompany\Integrations\PowerBi\Tools;

use OpenCompany\Integrations\PowerBi\PowerBiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the authenticated user's Power BI profile information.
 *
 * Returns the user profile including id, displayName, email,
 * and other account details from the Power BI service.
 */
class PowerBiGetCurrentUser implements Tool
{
    public function __construct(
        private PowerBiService $service,
    ) {}

    public function name(): string
    {
        return 'powerbi_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated user\'s Power BI profile, including display name and email address.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Power BI integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
