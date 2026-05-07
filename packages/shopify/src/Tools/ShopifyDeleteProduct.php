<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete a Shopify Product.
 */
class ShopifyDeleteProduct extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_product';

    protected string $toolDescription = 'Delete a Shopify Product.';

    protected string $method = 'DELETE';

    protected string $path = '/products/{product_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'product_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Product ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'product_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}