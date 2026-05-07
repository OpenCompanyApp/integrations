<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a Shopify inventory item.
 */
class ShopifyUpdateInventoryItem extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_inventory_item';

    protected string $toolDescription = 'Update a Shopify inventory item.';

    protected string $method = 'PUT';

    protected string $path = '/inventory_items/{inventory_item_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'inventory_item_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify inventory item ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Inventory item update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'inventory_item_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}