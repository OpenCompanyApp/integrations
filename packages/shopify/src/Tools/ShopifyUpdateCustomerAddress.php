<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a customer Address.
 */
class ShopifyUpdateCustomerAddress extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_customer_address';

    protected string $toolDescription = 'Update a customer Address.';

    protected string $method = 'PUT';

    protected string $path = '/customers/{customer_id}/addresses/{address_id}.json';

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
        'description' => 'Shopify Address ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented customer Address update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'customer_id',
    'address_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}