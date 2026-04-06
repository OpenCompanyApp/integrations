<?php

namespace OpenCompany\Integrations\Brandfetch\Tools;

use OpenCompany\Integrations\Brandfetch\BrandfetchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated user's account details.
 *
 * Returns user profile information including name, email, plan,
 * and usage details for the Brandfetch account associated with
 * the configured access token.
 */
class BrandfetchGetCurrentUser implements Tool
{
    public function __construct(
        private BrandfetchService $service,
    ) {}

    public function name(): string
    {
        return 'brandfetch_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated user\'s Brandfetch account details, including name, email, plan, and usage information.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Brandfetch integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
