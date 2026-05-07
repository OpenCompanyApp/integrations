<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a customer Metafield.
 */
class ShopifyUpdateCustomerMetafield extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_customer_metafield';

    protected string $toolDescription = 'Update a customer Metafield.';

    protected string $method = 'PUT';

    protected string $path = '/customers/{customer_id}/metafields/{metafield_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'customer_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify customer ID.',
    ],
    'metafield_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Metafield ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented customer Metafield update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'customer_id',
    'metafield_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}