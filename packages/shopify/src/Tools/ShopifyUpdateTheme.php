<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a Shopify Theme.
 */
class ShopifyUpdateTheme extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_theme';

    protected string $toolDescription = 'Update a Shopify Theme.';

    protected string $method = 'PUT';

    protected string $path = '/themes/{theme_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'theme_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Theme ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Theme update body.',
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