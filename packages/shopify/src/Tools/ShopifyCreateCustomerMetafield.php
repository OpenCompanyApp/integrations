<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Create a customer Metafield.
 */
class ShopifyCreateCustomerMetafield extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_create_customer_metafield';

    protected string $toolDescription = 'Create a customer Metafield.';

    protected string $method = 'POST';

    protected string $path = '/customers/{customer_id}/metafields.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'customer_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify customer ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented customer Metafield request body.',
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