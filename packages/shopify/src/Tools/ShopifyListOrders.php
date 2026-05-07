<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * List Shopify Orders.
 */
class ShopifyListOrders extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_list_orders';

    protected string $toolDescription = 'List Shopify Orders.';

    protected string $method = 'GET';

    protected string $path = '/orders.json';

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
    'financial_status' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify financial_status filter when supported.',
    ],
    'fulfillment_status' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify fulfillment_status filter when supported.',
    ],
    'created_at_min' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify created_at_min filter when supported.',
    ],
    'created_at_max' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify created_at_max filter when supported.',
    ],
    'updated_at_min' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify updated_at_min filter when supported.',
    ],
    'updated_at_max' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify updated_at_max filter when supported.',
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
    'financial_status',
    'fulfillment_status',
    'created_at_min',
    'created_at_max',
    'updated_at_min',
    'updated_at_max',
    'fields',
    'ids',
    'since_id',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}