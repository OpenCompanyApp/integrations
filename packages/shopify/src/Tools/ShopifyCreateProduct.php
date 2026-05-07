<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Create a Shopify Product.
 */
class ShopifyCreateProduct extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_create_product';

    protected string $toolDescription = 'Create a Shopify Product.';

    protected string $method = 'POST';

    protected string $path = '/products.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Product request body, usually wrapped under its resource key.',
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