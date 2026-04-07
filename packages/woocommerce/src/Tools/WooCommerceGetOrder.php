<?php

namespace OpenCompany\Integrations\Woocommerce\Tools;

use OpenCompany\Integrations\Woocommerce\WoocommerceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single order from the WooCommerce store by ID.
 */
class WoocommerceGetOrder implements Tool
{
    public function __construct(
        private WoocommerceService $service,
    ) {}

    public function name(): string
    {
        return 'woocommerce_get_order';
    }

    public function description(): string
    {
        return 'Get a single order from the WooCommerce store by its ID. Returns full order details including line items and totals.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The order ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('WooCommerce integration is not configured.');
            }

            $result = $this->service->getOrder((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
