<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

use OpenCompany\Integrations\BigCommerce\BigCommerceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing product in the BigCommerce catalog.
 *
 * Only the fields provided in the request will be updated.
 */
class BigCommerceUpdateProduct implements Tool
{
    public function __construct(
        private BigCommerceService $service,
    ) {}

    public function name(): string
    {
        return 'bigcommerce_update_product';
    }

    public function description(): string
    {
        return 'Update an existing product in the BigCommerce catalog. Only the fields you provide will be changed.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The product ID to update.'],
            'name' => ['type' => 'string', 'description' => 'Updated product name.'],
            'price' => ['type' => 'number', 'description' => 'Updated base price.'],
            'type' => ['type' => 'string', 'description' => 'Updated product type: "physical", "digital", or "giftcertificate".'],
            'sku' => ['type' => 'string', 'description' => 'Updated SKU.'],
            'description' => ['type' => 'string', 'description' => 'Updated product description (HTML allowed).'],
            'weight' => ['type' => 'number', 'description' => 'Updated weight.'],
            'categories' => ['type' => 'array', 'description' => 'Updated array of category IDs.'],
            'brand_id' => ['type' => 'integer', 'description' => 'Updated brand ID.'],
            'inventory_tracking' => ['type' => 'string', 'description' => 'Updated inventory tracking: "none", "product", or "variant".'],
            'inventory_level' => ['type' => 'integer', 'description' => 'Updated stock level.'],
            'is_visible' => ['type' => 'boolean', 'description' => 'Updated visibility on the storefront.'],
            'custom_fields' => ['type' => 'array', 'description' => 'Updated custom fields (replaces all existing).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('BigCommerce integration is not configured.');
            }

            $productId = (int) $args['id'];
            $data = [];

            $updatableFields = [
                'name', 'price', 'type', 'sku', 'description', 'weight',
                'categories', 'brand_id', 'inventory_tracking', 'inventory_level',
                'is_visible', 'custom_fields',
            ];

            foreach ($updatableFields as $field) {
                if (isset($args[$field])) {
                    $data[$field] = $field === 'price' ? (string) $args[$field] : $args[$field];
                }
            }

            if (empty($data)) {
                return ToolResult::error('No fields provided to update. Provide at least one field besides "id".');
            }

            $result = $this->service->updateProduct($productId, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
