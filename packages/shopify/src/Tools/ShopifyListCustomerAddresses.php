<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * List Addresses for a Shopify customer.
 */
class ShopifyListCustomerAddresses extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_list_customer_addresses';

    protected string $toolDescription = 'List Addresses for a Shopify customer.';

    protected string $method = 'GET';

    protected string $path = '/customers/{customer_id}/addresses.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'customer_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify customer ID.',
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
    'customer_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'limit',
    'page_info',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}