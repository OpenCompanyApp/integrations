<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one customer Metafield.
 */
class ShopifyGetCustomerMetafield extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_customer_metafield';

    protected string $toolDescription = 'Get one customer Metafield.';

    protected string $method = 'GET';

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
];

    /** @var list<string> */
    protected array $required = [
    'customer_id',
    'metafield_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}