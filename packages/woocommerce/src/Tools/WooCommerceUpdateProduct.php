<?php

namespace OpenCompany\Integrations\WooCommerce\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\WooCommerce\WooCommerceService;

/**
 * Tool: woocommerce_update_product
 *
 * Updates an existing WooCommerce product.
 */
class WooCommerceUpdateProduct implements Tool
{
    public function __construct(
        private WooCommerceService $service,
    ) {}

    public function name(): string
    {
        return 'woocommerce_update_product';
    }

    public function description(): string
    {
        return 'Update an existing WooCommerce product. Provide the product ID and the fields to change.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id'                => ['type' => 'integer', 'required' => true, 'description' => 'The product ID to update.'],
            'name'              => ['type' => 'string',  'description' => 'New product name.'],
            'status'            => ['type' => 'string',  'description' => 'Product status: publish, draft, pending, private.'],
            'regular_price'     => ['type' => 'string',  'description' => 'New regular price.'],
            'sale_price'        => ['type' => 'string',  'description' => 'New sale price.'],
            'description'       => ['type' => 'string',  'description' => 'Product description.'],
            'short_description' => ['type' => 'string',  'description' => 'Short product description.'],
            'sku'               => ['type' => 'string',  'description' => 'Stock-keeping unit.'],
            'manage_stock'      => ['type' => 'boolean', 'description' => 'Enable or disable stock management.'],
            'stock_quantity'    => ['type' => 'integer', 'description' => 'Stock quantity.'],
            'categories'        => ['type' => 'array',   'description' => 'List of category objects.'],
            'images'            => ['type' => 'array',   'description' => 'List of image objects.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('WooCommerce integration is not configured.');
            }

            $id = (int) ($args['id'] ?? 0);

            if ($id <= 0) {
                return ToolResult::error('A valid product ID is required.');
            }

            $data = array_filter($args, fn ($v, $k) => $v !== null && $k !== 'id', ARRAY_FILTER_USE_BOTH);

            if (empty($data)) {
                return ToolResult::error('No fields provided to update.');
            }

            $result = $this->service->updateProduct($id, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
