<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Calculate refund transactions for an order.
 */
class ShopifyCalculateOrderRefund extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_calculate_order_refund';

    protected string $toolDescription = 'Calculate refund transactions for an order.';

    protected string $method = 'POST';

    protected string $path = '/orders/{order_id}/refunds/calculate.json';

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
        'description' => 'Refund calculation body.',
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