<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Cancel a Shopify order.
 */
class ShopifyCancelOrder extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_cancel_order';

    protected string $toolDescription = 'Cancel a Shopify order.';

    protected string $method = 'POST';

    protected string $path = '/orders/{order_id}/cancel.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'order_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify order ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Cancellation options such as reason, amount, currency, refund, or restock.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'order_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}