<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a Shopify Order.
 */
class ShopifyUpdateOrder extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_order';

    protected string $toolDescription = 'Update a Shopify Order.';

    protected string $method = 'PUT';

    protected string $path = '/orders/{order_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'order_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Order ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Order update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'order_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}