<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Connect an inventory item to a location.
 */
class ShopifyConnectInventoryLevel extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_connect_inventory_level';

    protected string $toolDescription = 'Connect an inventory item to a location.';

    protected string $method = 'POST';

    protected string $path = '/inventory_levels/connect.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Inventory level connect body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}