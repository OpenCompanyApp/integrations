<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Create a product Variant.
 */
class ShopifyCreateProductVariant extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_create_product_variant';

    protected string $toolDescription = 'Create a product Variant.';

    protected string $method = 'POST';

    protected string $path = '/products/{product_id}/variants.json';

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
        'description' => 'Documented product Variant request body.',
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