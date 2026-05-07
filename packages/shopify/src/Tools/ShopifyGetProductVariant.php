<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one product Variant.
 */
class ShopifyGetProductVariant extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_product_variant';

    protected string $toolDescription = 'Get one product Variant.';

    protected string $method = 'GET';

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
];

    /** @var list<string> */
    protected array $required = [
    'product_id',
    'variant_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}