<?php

namespace OpenCompany\Integrations\Later\Tools;

use OpenCompany\Integrations\Later\LaterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Later user.
 *
 * Returns the profile of the authenticated user, including
 * name, email, and account details.
 */
class LaterGetCurrentUser implements Tool
{
    public function __construct(
        private LaterService $service,
    ) {}

    public function name(): string
    {
        return 'later_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Later user profile. Returns the user name, email, and account info.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Later integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
