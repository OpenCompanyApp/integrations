<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete an inventory level.
 */
class ShopifyDeleteInventoryLevel extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_inventory_level';

    protected string $toolDescription = 'Delete an inventory level.';

    protected string $method = 'DELETE';

    protected string $path = '/inventory_levels.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'inventory_item_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Inventory item ID.',
    ],
    'location_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Location ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'inventory_item_id',
    'location_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'inventory_item_id',
    'location_id',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}