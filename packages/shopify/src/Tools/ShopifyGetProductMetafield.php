<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one product Metafield.
 */
class ShopifyGetProductMetafield extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_product_metafield';

    protected string $toolDescription = 'Get one product Metafield.';

    protected string $method = 'GET';

    protected string $path = '/products/{product_id}/metafields/{metafield_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'product_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify product ID.',
    ],
    'metafield_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Metafield ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'product_id',
    'metafield_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}