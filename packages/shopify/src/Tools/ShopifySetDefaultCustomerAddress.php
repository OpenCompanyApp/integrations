<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Set the default address for a customer.
 */
class ShopifySetDefaultCustomerAddress extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_set_default_customer_address';

    protected string $toolDescription = 'Set the default address for a customer.';

    protected string $method = 'PUT';

    protected string $path = '/customers/{customer_id}/addresses/{address_id}/default.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'customer_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify customer ID.',
    ],
    'address_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Customer address ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Optional request body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'customer_id',
    'address_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}