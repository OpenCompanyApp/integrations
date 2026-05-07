<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update an order Fulfillment.
 */
class ShopifyUpdateOrderFulfillment extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_order_fulfillment';

    protected string $toolDescription = 'Update an order Fulfillment.';

    protected string $method = 'PUT';

    protected string $path = '/orders/{order_id}/fulfillments/{fulfillment_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'order_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify order ID.',
    ],
    'fulfillment_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Fulfillment ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented order Fulfillment update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'order_id',
    'fulfillment_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}