<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a Shopify Customer.
 */
class ShopifyUpdateCustomer extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_customer';

    protected string $toolDescription = 'Update a Shopify Customer.';

    protected string $method = 'PUT';

    protected string $path = '/customers/{customer_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'customer_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Customer ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Customer update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'customer_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}