<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Create a product Metafield.
 */
class ShopifyCreateProductMetafield extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_create_product_metafield';

    protected string $toolDescription = 'Create a product Metafield.';

    protected string $method = 'POST';

    protected string $path = '/products/{product_id}/metafields.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'product_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify product ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented product Metafield request body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'product_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}