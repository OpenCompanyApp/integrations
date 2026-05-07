<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * List Shopify Inventory Items.
 */
class ShopifyListInventoryItems extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_list_inventory_items';

    protected string $toolDescription = 'List Shopify Inventory Items.';

    protected string $method = 'GET';

    protected string $path = '/inventory_items.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'limit' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify limit filter when supported.',
    ],
    'page_info' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify page_info filter when supported.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Shopify query parameters to pass through.',
    ],
    'ids' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify ids filter when supported.',
    ],
];

    /** @var list<string> */
    protected array $required = [];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'limit',
    'page_info',
    'ids',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}