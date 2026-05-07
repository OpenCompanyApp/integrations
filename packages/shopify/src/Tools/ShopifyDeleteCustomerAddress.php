<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete a customer Address.
 */
class ShopifyDeleteCustomerAddress extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_customer_address';

    protected string $toolDescription = 'Delete a customer Address.';

    protected string $method = 'DELETE';

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
];

    /** @var list<string> */
    protected array $required = [
    'customer_id',
    'address_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}