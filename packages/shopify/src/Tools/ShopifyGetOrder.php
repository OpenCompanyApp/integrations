<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one Shopify Order.
 */
class ShopifyGetOrder extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_order';

    protected string $toolDescription = 'Get one Shopify Order.';

    protected string $method = 'GET';

    protected string $path = '/orders/{order_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'order_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Order ID.',
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
    'order_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'fields',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}