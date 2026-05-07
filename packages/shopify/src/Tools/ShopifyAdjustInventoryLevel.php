<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Adjust available inventory at a location.
 */
class ShopifyAdjustInventoryLevel extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_adjust_inventory_level';

    protected string $toolDescription = 'Adjust available inventory at a location.';

    protected string $method = 'POST';

    protected string $path = '/inventory_levels/adjust.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Inventory level adjustment body.',
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