<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Create a Shopify Customer.
 */
class ShopifyCreateCustomer extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_create_customer';

    protected string $toolDescription = 'Create a Shopify Customer.';

    protected string $method = 'POST';

    protected string $path = '/customers.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Customer request body, usually wrapped under its resource key.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}