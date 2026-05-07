<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a product Metafield.
 */
class ShopifyUpdateProductMetafield extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_product_metafield';

    protected string $toolDescription = 'Update a product Metafield.';

    protected string $method = 'PUT';

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
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented product Metafield update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'product_id',
    'metafield_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}