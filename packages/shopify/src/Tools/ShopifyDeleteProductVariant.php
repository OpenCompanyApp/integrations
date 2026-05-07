<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete a product Variant.
 */
class ShopifyDeleteProductVariant extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_product_variant';

    protected string $toolDescription = 'Delete a product Variant.';

    protected string $method = 'DELETE';

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