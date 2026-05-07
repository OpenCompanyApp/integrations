<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one Shopify Customer.
 */
class ShopifyGetCustomer extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_customer';

    protected string $toolDescription = 'Get one Shopify Customer.';

    protected string $method = 'GET';

    protected string $path = '/customers/{customer_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'customer_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Customer ID.',
    ],
    'fields' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Comma-separated fields to return.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented query parameters.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'customer_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'fields',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}