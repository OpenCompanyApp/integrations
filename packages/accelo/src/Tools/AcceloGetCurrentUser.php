<?php

namespace OpenCompany\Integrations\Accelo\Tools;

use OpenCompany\Integrations\Accelo\AcceloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: accelo_get_current_user
 *
 * Retrieves the profile of the currently authenticated Accelo user.
 */
class AcceloGetCurrentUser implements Tool
{
    public function __construct(
        private AcceloService $service,
    ) {}

    public function name(): string
    {
        return 'accelo_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Accelo user. Use this to verify credentials and see user details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Accelo integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
