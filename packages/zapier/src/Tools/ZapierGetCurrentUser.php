<?php

namespace OpenCompany\Integrations\Zapier\Tools;

use OpenCompany\Integrations\Zapier\ZapierService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Zapier user.
 */
class ZapierGetCurrentUser implements Tool
{
    /**
     * @param  ZapierService  $service  The Zapier API client
     */
    public function __construct(
        private ZapierService $service,
    ) {}

    public function name(): string
    {
        return 'zapier_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Zapier user.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve the currently authenticated user's profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zapier integration is not configured.');
            }

            $user = $this->service->getCurrentUser();

            return ToolResult::success($user);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
