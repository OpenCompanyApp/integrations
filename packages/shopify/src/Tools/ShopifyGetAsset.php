<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get a theme asset by key.
 */
class ShopifyGetAsset extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_asset';

    protected string $toolDescription = 'Get a theme asset by key.';

    protected string $method = 'GET';

    protected string $path = '/themes/{theme_id}/assets.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'theme_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Theme ID.',
    ],
    'asset[key]' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Asset key, such as templates/index.json.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional query parameters.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'theme_id',
    'asset[key]',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'asset[key]',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}