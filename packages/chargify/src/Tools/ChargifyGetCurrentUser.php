<?php

namespace OpenCompany\Integrations\Chargify\Tools;

use OpenCompany\Integrations\Chargify\ChargifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Chargify user.
 *
 * Returns user details including name, email, and role. Useful for
 * verifying API credentials and connection status.
 */
class ChargifyGetCurrentUser implements Tool
{
    public function __construct(
        private ChargifyService $service,
    ) {}

    public function name(): string
    {
        return 'chargify_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Chargify user. Useful for verifying API credentials.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chargify integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
