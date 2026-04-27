<?php

namespace OpenCompany\Integrations\Gravity\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Gravity\GravityService;

/**
 * Get the authenticated Gravity user profile.
 */
class GravityGetCurrentUser implements Tool
{
    /**
     * @param  GravityService  $service  The Gravity API client.
     */
    public function __construct(
        private GravityService $service,
    ) {}

    public function name(): string
    {
        return 'gravity_get_current_user';
    }

    public function description(): string
    {
        return 'Get profile information for the authenticated Gravity user.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get the authenticated user.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gravity integration is not configured.');
            }

            return ToolResult::success($this->service->getCurrentUser());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
