<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Create an order Fulfillment.
 */
class ShopifyCreateOrderFulfillment extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_create_order_fulfillment';

    protected string $toolDescription = 'Create an order Fulfillment.';

    protected string $method = 'POST';

    protected string $path = '/orders/{order_id}/fulfillments.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'order_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify order ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented order Fulfillment request body.',
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