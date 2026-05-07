<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * List Shopify Fulfillment Services.
 */
class ShopifyListFulfillmentServices extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_list_fulfillment_services';

    protected string $toolDescription = 'List Shopify Fulfillment Services.';

    protected string $method = 'GET';

    protected string $path = '/fulfillment_services.json';

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
    'scope' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify scope filter when supported.',
    ],
    'fields' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify fields filter when supported.',
    ],
];

    /** @var list<string> */
    protected array $required = [];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'limit',
    'page_info',
    'scope',
    'fields',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}