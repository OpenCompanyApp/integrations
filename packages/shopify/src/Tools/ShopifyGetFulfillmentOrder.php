<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one fulfillment order.
 */
class ShopifyGetFulfillmentOrder extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_fulfillment_order';

    protected string $toolDescription = 'Get one fulfillment order.';

    protected string $method = 'GET';

    protected string $path = '/fulfillment_orders/{fulfillment_order_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'fulfillment_order_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Fulfillment order ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'fulfillment_order_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}