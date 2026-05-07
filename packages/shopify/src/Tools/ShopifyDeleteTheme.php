<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete a Shopify Theme.
 */
class ShopifyDeleteTheme extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_theme';

    protected string $toolDescription = 'Delete a Shopify Theme.';

    protected string $method = 'DELETE';

    protected string $path = '/themes/{theme_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'theme_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Theme ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'theme_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}