<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Set available inventory at a location.
 */
class ShopifySetInventoryLevel extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_set_inventory_level';

    protected string $toolDescription = 'Set available inventory at a location.';

    protected string $method = 'POST';

    protected string $path = '/inventory_levels/set.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Inventory level set body.',
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