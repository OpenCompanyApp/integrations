<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\Integrations\Tapfiliate\TapfiliateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve the current Tapfiliate API profile.
 *
 * Useful for validating credentials and account context.
 */
class TapfiliateGetCurrentUser implements Tool
{
    /**
     * @param  TapfiliateService  $service  The Tapfiliate API client
     */
    public function __construct(
        private TapfiliateService $service,
    ) {}

    public function name(): string
    {
        return 'tapfiliate_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Tapfiliate user profile. Useful for verifying API credentials and checking account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get the current API user.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tapfiliate integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
