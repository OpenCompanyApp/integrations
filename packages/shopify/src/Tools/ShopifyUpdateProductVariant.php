<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a product Variant.
 */
class ShopifyUpdateProductVariant extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_product_variant';

    protected string $toolDescription = 'Update a product Variant.';

    protected string $method = 'PUT';

    protected string $path = '/products/{product_id}/variants/{variant_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'product_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify product ID.',
    ],
    'variant_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Variant ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented product Variant update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'product_id',
    'variant_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}