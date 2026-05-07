<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete a Shopify Customer.
 */
class ShopifyDeleteCustomer extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_customer';

    protected string $toolDescription = 'Delete a Shopify Customer.';

    protected string $method = 'DELETE';

    protected string $path = '/customers/{customer_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'customer_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Customer ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'customer_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}