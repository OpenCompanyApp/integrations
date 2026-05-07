<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one Shopify Inventory Item.
 */
class ShopifyGetInventoryItem extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_inventory_item';

    protected string $toolDescription = 'Get one Shopify Inventory Item.';

    protected string $method = 'GET';

    protected string $path = '/inventory_items/{inventory_item_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'inventory_item_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Inventory Item ID.',
    ],
    'fields' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Comma-separated fields to return.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented query parameters.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'inventory_item_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'fields',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}