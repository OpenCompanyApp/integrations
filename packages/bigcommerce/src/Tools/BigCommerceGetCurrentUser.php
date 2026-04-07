<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

use OpenCompany\Integrations\BigCommerce\BigCommerceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the storefront status from the BigCommerce store.
 *
 * Useful for verifying the API connection and retrieving store info.
 */
class BigCommerceGetCurrentUser implements Tool
{
    public function __construct(
        private BigCommerceService $service,
    ) {}

    public function name(): string
    {
        return 'bigcommerce_get_current_user';
    }

    public function description(): string
    {
        return 'Get the current user / storefront status from BigCommerce. Use this to verify the API connection is working.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('BigCommerce integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
