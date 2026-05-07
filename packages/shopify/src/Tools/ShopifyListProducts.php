<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * List Shopify Products.
 */
class ShopifyListProducts extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_list_products';

    protected string $toolDescription = 'List Shopify Products.';

    protected string $method = 'GET';

    protected string $path = '/products.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
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
    'status' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify status filter when supported.',
    ],
    'product_type' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify product_type filter when supported.',
    ],
    'vendor' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify vendor filter when supported.',
    ],
    'collection_id' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify collection_id filter when supported.',
    ],
    'published_status' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify published_status filter when supported.',
    ],
    'fields' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify fields filter when supported.',
    ],
    'ids' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify ids filter when supported.',
    ],
    'since_id' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify since_id filter when supported.',
    ],
];

    /** @var list<string> */
    protected array $required = [];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'limit',
    'page_info',
    'status',
    'product_type',
    'vendor',
    'collection_id',
    'published_status',
    'fields',
    'ids',
    'since_id',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}