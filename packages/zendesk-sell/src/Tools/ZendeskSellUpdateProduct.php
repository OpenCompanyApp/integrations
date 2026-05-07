<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Update a Zendesk Sell product.
 */
class ZendeskSellUpdateProduct extends ZendeskSellCreateProduct
{
    protected string $toolName = 'zendesk_sell_update_product';
    protected string $toolDescription = 'Update a Zendesk Sell product by ID.';
    protected string $method = 'PUT';
    protected string $path = '/v2/products/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Product ID.'],
        'name' => ['type' => 'string', 'description' => 'Product name.'],
        'description' => ['type' => 'string', 'description' => 'Product description.'],
        'sku' => ['type' => 'string', 'description' => 'SKU.'],
        'active' => ['type' => 'boolean', 'description' => 'Whether the product is active.'],
        'prices' => ['type' => 'array', 'description' => 'Price records.'],
        'max_discount' => ['type' => 'number', 'description' => 'Maximum discount.'],
    ];
}
