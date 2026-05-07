<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * List assets for a theme.
 */
class ShopifyListAssets extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_list_assets';

    protected string $toolDescription = 'List assets for a theme.';

    protected string $method = 'GET';

    protected string $path = '/themes/{theme_id}/assets.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'theme_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Theme ID.',
    ],
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
];

    /** @var list<string> */
    protected array $required = [
    'theme_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'limit',
    'page_info',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}