<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * List Shopify Collects.
 */
class ShopifyListCollects extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_list_collects';

    protected string $toolDescription = 'List Shopify Collects.';

    protected string $method = 'GET';

    protected string $path = '/collects.json';

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
    'collection_id' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify collection_id filter when supported.',
    ],
    'product_id' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify product_id filter when supported.',
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
    'collection_id',
    'product_id',
    'fields',
    'ids',
    'since_id',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}