<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Search Shopify customers.
 */
class ShopifySearchCustomers extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_search_customers';

    protected string $toolDescription = 'Search Shopify customers.';

    protected string $method = 'GET';

    protected string $path = '/customers/search.json';

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
    'q' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify customer search query.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'q',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'limit',
    'page_info',
    'q',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}