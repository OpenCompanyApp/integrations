<?php

namespace OpenCompany\Integrations\Crisp\Tools;

use OpenCompany\Integrations\Crisp\CrispService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * CrispGetCurrentUser — retrieve the authenticated user profile.
 *
 * Returns the currently authenticated operator/user details from Crisp,
 * useful for verifying credentials and displaying user context.
 */
class CrispGetCurrentUser implements Tool
{
    public function __construct(
        private CrispService $service,
    ) {}

    public function name(): string
    {
        return 'crisp_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Crisp user profile. Useful for verifying credentials and identifying the connected operator.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Crisp integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
