<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete a theme asset by key.
 */
class ShopifyDeleteAsset extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_asset';

    protected string $toolDescription = 'Delete a theme asset by key.';

    protected string $method = 'DELETE';

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
        'description' => 'Asset key.',
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