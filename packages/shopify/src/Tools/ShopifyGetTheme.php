<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one Shopify Theme.
 */
class ShopifyGetTheme extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_theme';

    protected string $toolDescription = 'Get one Shopify Theme.';

    protected string $method = 'GET';

    protected string $path = '/themes/{theme_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'theme_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Theme ID.',
    ],
    'fields' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Comma-separated fields to return.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented query parameters.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'theme_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'fields',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}