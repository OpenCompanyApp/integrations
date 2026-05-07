<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one Shopify Product.
 */
class ShopifyGetProduct extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_product';

    protected string $toolDescription = 'Get one Shopify Product.';

    protected string $method = 'GET';

    protected string $path = '/products/{product_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'product_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Product ID.',
    ],
    'fields' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Comma-separated fields to return.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented query parameters.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'product_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'fields',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}