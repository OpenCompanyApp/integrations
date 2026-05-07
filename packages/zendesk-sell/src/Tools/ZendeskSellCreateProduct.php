<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Create a Zendesk Sell product.
 */
class ZendeskSellCreateProduct extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_create_product';
    protected string $toolDescription = 'Create a Zendesk Sell product.';
    protected string $method = 'POST';
    protected string $path = '/v2/products';
    protected array $required = ['name'];
    protected array $bodyParams = ['name', 'description', 'sku', 'active', 'prices', 'max_discount'];
    protected array $parameters = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Product name.'],
        'description' => ['type' => 'string', 'description' => 'Product description.'],
        'sku' => ['type' => 'string', 'description' => 'SKU.'],
        'active' => ['type' => 'boolean', 'description' => 'Whether the product is active.'],
        'prices' => ['type' => 'array', 'description' => 'Price records.'],
        'max_discount' => ['type' => 'number', 'description' => 'Maximum discount.'],
    ];
}
