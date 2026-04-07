<?php

namespace OpenCompany\Integrations\Magento\Tools;

use OpenCompany\Integrations\Magento\MagentoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a new product in the Magento catalog.
 *
 * Creates a product with the specified attributes including SKU,
 * name, price, and type.
 */
class MagentoCreateProduct implements Tool
{
    /**
     * Create a new MagentoCreateProduct tool instance.
     *
     * @param  \OpenCompany\Integrations\Magento\MagentoService  $service
     */
    public function __construct(
        private MagentoService $service,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'magento_create_product';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Create a new product in the Magento catalog. Requires SKU, name, price, and attribute set ID. Returns the created product object.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'sku' => ['type' => 'string', 'required' => true, 'description' => 'Unique product SKU.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Product name.'],
            'price' => ['type' => 'number', 'required' => true, 'description' => 'Product price (e.g., 29.99).'],
            'attribute_set_id' => ['type' => 'integer', 'description' => 'Attribute set ID (default: 4 for Default).'],
            'type_id' => ['type' => 'string', 'description' => 'Product type (simple, configurable, virtual, etc.). Default: "simple".'],
            'weight' => ['type' => 'number', 'description' => 'Product weight.'],
            'description' => ['type' => 'string', 'description' => 'Full product description.'],
            'short_description' => ['type' => 'string', 'description' => 'Short product description.'],
            'visibility' => ['type' => 'integer', 'description' => 'Visibility (1=Not Visible, 2=Catalog, 3=Search, 4=Catalog & Search). Default: 4.'],
            'status' => ['type' => 'integer', 'description' => 'Product status (1=Enabled, 2=Disabled). Default: 1.'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Magento integration is not configured.');
            }

            $sku = $args['sku'] ?? '';
            $name = $args['name'] ?? '';

            if (empty($sku)) {
                return ToolResult::error('sku is required.');
            }

            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            if (! isset($args['price'])) {
                return ToolResult::error('price is required.');
            }

            $data = [
                'sku' => $sku,
                'name' => $name,
                'price' => (float) $args['price'],
                'attribute_set_id' => $args['attribute_set_id'] ?? 4,
                'type_id' => $args['type_id'] ?? 'simple',
            ];

            if (isset($args['weight'])) {
                $data['weight'] = (float) $args['weight'];
            }

            if (isset($args['description'])) {
                $data['custom_attributes'][] = ['attribute_code' => 'description', 'value' => $args['description']];
            }

            if (isset($args['short_description'])) {
                $data['custom_attributes'][] = ['attribute_code' => 'short_description', 'value' => $args['short_description']];
            }

            if (isset($args['visibility'])) {
                $data['visibility'] = (int) $args['visibility'];
            }

            if (isset($args['status'])) {
                $data['status'] = (int) $args['status'];
            }

            $result = $this->service->createProduct($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
