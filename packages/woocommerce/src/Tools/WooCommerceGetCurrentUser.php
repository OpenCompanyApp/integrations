<?php

namespace OpenCompany\Integrations\Woocommerce\Tools;

use OpenCompany\Integrations\Woocommerce\WoocommerceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the system status from the WooCommerce store.
 *
 * Useful for verifying the API connection and retrieving store info.
 */
class WoocommerceGetCurrentUser implements Tool
{
    public function __construct(
        private WoocommerceService $service,
    ) {}

    public function name(): string
    {
        return 'woocommerce_get_current_user';
    }

    public function description(): string
    {
        return 'Get the system status from WooCommerce. Use this to verify the API connection is working and retrieve store information.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('WooCommerce integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
