<?php

namespace OpenCompany\Integrations\WpEngine\Tools;

use OpenCompany\Integrations\WpEngine\WpEngineService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated WP Engine user profile.
 *
 * Returns information about the authenticated user, useful for verifying
 * credentials and displaying account details.
 */
class WpEngineGetCurrentUser implements Tool
{
    public function __construct(
        private WpEngineService $service,
    ) {}

    public function name(): string
    {
        return 'wp_engine_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated WP Engine user. Useful for verifying credentials and displaying account information.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('WP Engine integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
