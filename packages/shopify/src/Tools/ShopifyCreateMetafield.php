<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Create a shop-level metafield.
 */
class ShopifyCreateMetafield extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_create_metafield';

    protected string $toolDescription = 'Create a shop-level metafield.';

    protected string $method = 'POST';

    protected string $path = '/metafields.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Metafield request body.',
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