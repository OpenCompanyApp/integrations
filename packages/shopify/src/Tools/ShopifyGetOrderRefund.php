<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one order Refund.
 */
class ShopifyGetOrderRefund extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_order_refund';

    protected string $toolDescription = 'Get one order Refund.';

    protected string $method = 'GET';

    protected string $path = '/orders/{order_id}/refunds/{refund_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'order_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify order ID.',
    ],
    'refund_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Refund ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'order_id',
    'refund_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}