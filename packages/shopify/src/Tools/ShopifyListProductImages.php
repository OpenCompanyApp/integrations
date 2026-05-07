<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * List Images for a Shopify product.
 */
class ShopifyListProductImages extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_list_product_images';

    protected string $toolDescription = 'List Images for a Shopify product.';

    protected string $method = 'GET';

    protected string $path = '/products/{product_id}/images.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'product_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify product ID.',
    ],
    'limit' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Maximum number of records to return.',
    ],
    'page_info' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Cursor pagination token from Shopify Link headers.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Shopify query parameters to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'product_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'limit',
    'page_info',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}