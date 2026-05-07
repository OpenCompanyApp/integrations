<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Reopen a Shopify order.
 */
class ShopifyReopenOrder extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_reopen_order';

    protected string $toolDescription = 'Reopen a Shopify order.';

    protected string $method = 'POST';

    protected string $path = '/orders/{order_id}/open.json';

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
        'description' => 'Optional reopen body.',
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