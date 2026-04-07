<?php

namespace OpenCompany\Integrations\Woocommerce\Tools;

use OpenCompany\Integrations\Woocommerce\WoocommerceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single product from the WooCommerce catalog by ID.
 */
class WoocommerceGetProduct implements Tool
{
    public function __construct(
        private WoocommerceService $service,
    ) {}

    public function name(): string
    {
        return 'woocommerce_get_product';
    }

    public function description(): string
    {
        return 'Get a single product from the WooCommerce catalog by its ID. Returns full product details.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The product ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('WooCommerce integration is not configured.');
            }

            $result = $this->service->getProduct((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
