<?php

namespace OpenCompany\Integrations\Convex\Tools;

use OpenCompany\Integrations\Convex\ConvexService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the authenticated Convex user's profile information.
 *
 * Returns user details including name, email, and team information.
 * Useful for verifying API connectivity and account status.
 */
class ConvexGetCurrentUser implements Tool
{
    public function __construct(
        private ConvexService $service,
    ) {}

    public function name(): string
    {
        return 'convex_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Convex user\'s profile information. Returns account details like name and email. Use this to verify API connectivity.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Convex integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
