<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * List assigned fulfillment orders.
 */
class ShopifyListFulfillmentOrders extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_list_fulfillment_orders';

    protected string $toolDescription = 'List assigned fulfillment orders.';

    protected string $method = 'GET';

    protected string $path = '/assigned_fulfillment_orders.json';

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
    'assignment_status' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Assignment status filter.',
    ],
    'location_ids' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Comma-separated location IDs.',
    ],
];

    /** @var list<string> */
    protected array $required = [];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'limit',
    'page_info',
    'assignment_status',
    'location_ids',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}