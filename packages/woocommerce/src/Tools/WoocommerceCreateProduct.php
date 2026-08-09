<?php

namespace OpenCompany\Integrations\Woocommerce\Tools;

use OpenCompany\Integrations\Woocommerce\WoocommerceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new product in the WooCommerce catalog.
 *
 * Requires at minimum a name and regular_price.
 * Supports all product fields including SKU, description,
 * weight, categories, images, and custom fields.
 */
class WoocommerceCreateProduct implements Tool
{
    public function __construct(
        private WoocommerceService $service,
    ) {}

    public function name(): string
    {
        return 'woocommerce_create_product';
    }

    public function description(): string
    {
        return 'Create a new product in the WooCommerce catalog. Requires name and regular_price. Supports type (simple, grouped, external, variable), SKU, description, and more.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Product name.'],
            'regular_price' => ['type' => 'string', 'required' => true, 'description' => 'Base price (e.g., "29.99").'],
            'type' => ['type' => 'string', 'description' => 'Product type: "simple", "grouped", "external", or "variable" (default: "simple").'],
            'sku' => ['type' => 'string', 'description' => 'Unique SKU for the product.'],
            'description' => ['type' => 'string', 'description' => 'Product description (HTML allowed).'],
            'short_description' => ['type' => 'string', 'description' => 'Short product description.'],
            'weight' => ['type' => 'string', 'description' => 'Weight of the product.'],
            'categories' => ['type' => 'array', 'description' => 'Array of category objects with "id" keys.'],
            'manage_stock' => ['type' => 'boolean', 'description' => 'Whether to enable stock management (default: false).'],
            'stock_quantity' => ['type' => 'integer', 'description' => 'Stock level (when manage_stock is true).'],
            'status' => ['type' => 'string', 'description' => 'Product status: "publish", "draft", "pending", or "private" (default: "publish").'],
            'images' => ['type' => 'array', 'description' => 'Array of image objects with "src" key.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('WooCommerce integration is not configured.');
            }

            $data = [
                'name' => $args['name'],
                'regular_price' => (string) $args['regular_price'],
            ];

            $optionalFields = [
                'type', 'sku', 'description', 'short_description', 'weight',
                'categories', 'manage_stock', 'stock_quantity', 'status',
                'images',
            ];

            foreach ($optionalFields as $field) {
                if (isset($args[$field])) {
                    $data[$field] = $args[$field];
                }
            }

            $result = $this->service->createProduct($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
