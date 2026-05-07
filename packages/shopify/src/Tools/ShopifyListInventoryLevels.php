<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * List Shopify inventory levels.
 */
class ShopifyListInventoryLevels extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_list_inventory_levels';

    protected string $toolDescription = 'List Shopify inventory levels.';

    protected string $method = 'GET';

    protected string $path = '/inventory_levels.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'limit' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Maximum number of records to return.',
    ],
    'page_info' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Cursor pagination token from Shopify Link headers.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Shopify query parameters to pass through.',
    ],
    'inventory_item_ids' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Comma-separated inventory item IDs.',
    ],
    'location_ids' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Comma-separated location IDs.',
    ],
];

    /** @var list<string> */
    protected array $required = [];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'limit',
    'page_info',
    'inventory_item_ids',
    'location_ids',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}