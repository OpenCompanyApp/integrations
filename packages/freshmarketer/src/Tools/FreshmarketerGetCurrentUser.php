<?php

namespace OpenCompany\Integrations\Freshmarketer\Tools;

use OpenCompany\Integrations\Freshmarketer\FreshmarketerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * FreshmarketerGetCurrentUser — retrieve the currently authenticated user profile.
 *
 * Calls GET /api/v1/users/me to fetch the authenticated user's details.
 */
class FreshmarketerGetCurrentUser implements Tool
{
    public function __construct(
        private FreshmarketerService $service,
    ) {}

    public function name(): string
    {
        return 'freshmarketer_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Freshmarketer user.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshmarketer integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
