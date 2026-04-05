<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

use OpenCompany\Integrations\BigCommerce\BigCommerceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new product in the BigCommerce catalog.
 *
 * Requires at minimum a name, price, and type.
 * Supports all product fields including SKU, description,
 * weight, categories, images, and custom fields.
 */
class BigCommerceCreateProduct implements Tool
{
    public function __construct(
        private BigCommerceService $service,
    ) {}

    public function name(): string
    {
        return 'bigcommerce_create_product';
    }

    public function description(): string
    {
        return 'Create a new product in the BigCommerce catalog. Requires name, price, and type (physical, digital, or giftcertificate).';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Product name.'],
            'price' => ['type' => 'number', 'required' => true, 'description' => 'Base price (e.g., 29.99). Use 0 for free products.'],
            'type' => ['type' => 'string', 'required' => true, 'description' => 'Product type: "physical", "digital", or "giftcertificate".'],
            'sku' => ['type' => 'string', 'description' => 'Unique SKU for the product.'],
            'description' => ['type' => 'string', 'description' => 'Product description (HTML allowed).'],
            'weight' => ['type' => 'number', 'description' => 'Weight of the product (required for physical products).'],
            'categories' => ['type' => 'array', 'description' => 'Array of category IDs to assign the product to.'],
            'brand_id' => ['type' => 'integer', 'description' => 'The brand ID to assign.'],
            'inventory_tracking' => ['type' => 'string', 'description' => 'Inventory tracking: "none", "product", or "variant".'],
            'inventory_level' => ['type' => 'integer', 'description' => 'Current stock level (when inventory_tracking is "product").'],
            'is_visible' => ['type' => 'boolean', 'description' => 'Whether the product is visible on the storefront (default: true).'],
            'custom_fields' => ['type' => 'array', 'description' => 'Array of custom field objects with "name" and "value" keys.'],
            'images' => ['type' => 'array', 'description' => 'Array of image objects with "image_url" key.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('BigCommerce integration is not configured.');
            }

            $data = [
                'name' => $args['name'],
                'price' => (string) $args['price'],
                'type' => $args['type'],
            ];

            $optionalFields = [
                'sku', 'description', 'weight', 'categories', 'brand_id',
                'inventory_tracking', 'inventory_level', 'is_visible',
                'custom_fields', 'images',
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
