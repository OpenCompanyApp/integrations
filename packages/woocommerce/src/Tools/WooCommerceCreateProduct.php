<?php

namespace OpenCompany\Integrations\WooCommerce\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\WooCommerce\WooCommerceService;

/**
 * Tool: woocommerce_create_product
 *
 * Creates a new product in the WooCommerce store.
 */
class WooCommerceCreateProduct implements Tool
{
    public function __construct(
        private WooCommerceService $service,
    ) {}

    public function name(): string
    {
        return 'woocommerce_create_product';
    }

    public function description(): string
    {
        return 'Create a new product in the WooCommerce store. Provide at least a name; other fields are optional.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'name'          => ['type' => 'string',  'required' => true,  'description' => 'Product name.'],
            'type'          => ['type' => 'string',  'description' => 'Product type: simple, grouped, external, variable (default: simple).'],
            'status'        => ['type' => 'string',  'description' => 'Product status: publish, draft, pending, private (default: publish).'],
            'regular_price' => ['type' => 'string',  'description' => 'Regular price (e.g. "19.99").'],
            'sale_price'    => ['type' => 'string',  'description' => 'Sale price (e.g. "14.99").'],
            'description'   => ['type' => 'string',  'description' => 'Product description (HTML allowed).'],
            'short_description' => ['type' => 'string', 'description' => 'Short product description.'],
            'sku'           => ['type' => 'string',  'description' => 'Unique stock-keeping unit.'],
            'manage_stock'  => ['type' => 'boolean', 'description' => 'Whether to enable stock management.'],
            'stock_quantity' => ['type' => 'integer', 'description' => 'Stock quantity when manage_stock is true.'],
            'categories'    => ['type' => 'array',   'description' => 'List of category objects, e.g. [{"id": 42}].'],
            'images'        => ['type' => 'array',   'description' => 'List of image objects, e.g. [{"src": "https://..."}].'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('WooCommerce integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('Product name is required.');
            }

            $data = array_filter($args, fn ($v, $k) => $v !== null && $k !== '', ARRAY_FILTER_USE_BOTH);

            $result = $this->service->createProduct($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
