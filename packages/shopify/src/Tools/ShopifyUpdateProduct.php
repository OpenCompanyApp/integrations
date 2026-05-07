<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a Shopify Product.
 */
class ShopifyUpdateProduct extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_product';

    protected string $toolDescription = 'Update a Shopify Product.';

    protected string $method = 'PUT';

    protected string $path = '/products/{product_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'product_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Product ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Product update body.',
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