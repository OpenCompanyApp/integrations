<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Create or update a theme asset.
 */
class ShopifyPutAsset extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_put_asset';

    protected string $toolDescription = 'Create or update a theme asset.';

    protected string $method = 'PUT';

    protected string $path = '/themes/{theme_id}/assets.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'theme_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Theme ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Asset request body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'theme_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}