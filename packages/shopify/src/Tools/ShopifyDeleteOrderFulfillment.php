<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete an order Fulfillment.
 */
class ShopifyDeleteOrderFulfillment extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_order_fulfillment';

    protected string $toolDescription = 'Delete an order Fulfillment.';

    protected string $method = 'DELETE';

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
];

    /** @var list<string> */
    protected array $required = [
    'order_id',
    'fulfillment_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}