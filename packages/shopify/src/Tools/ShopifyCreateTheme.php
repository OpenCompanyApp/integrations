<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Create a Shopify Theme.
 */
class ShopifyCreateTheme extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_create_theme';

    protected string $toolDescription = 'Create a Shopify Theme.';

    protected string $method = 'POST';

    protected string $path = '/themes.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Theme request body, usually wrapped under its resource key.',
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