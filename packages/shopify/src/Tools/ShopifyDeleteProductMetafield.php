<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete a product Metafield.
 */
class ShopifyDeleteProductMetafield extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_product_metafield';

    protected string $toolDescription = 'Delete a product Metafield.';

    protected string $method = 'DELETE';

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