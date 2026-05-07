<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Close a Shopify order.
 */
class ShopifyCloseOrder extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_close_order';

    protected string $toolDescription = 'Close a Shopify order.';

    protected string $method = 'POST';

    protected string $path = '/orders/{order_id}/close.json';

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
        'description' => 'Optional close body.',
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