<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one order Transaction.
 */
class ShopifyGetOrderTransaction extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_order_transaction';

    protected string $toolDescription = 'Get one order Transaction.';

    protected string $method = 'GET';

    protected string $path = '/orders/{order_id}/transactions/{transaction_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'order_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify order ID.',
    ],
    'transaction_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Transaction ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'order_id',
    'transaction_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}