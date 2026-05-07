<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Create an order Transaction.
 */
class ShopifyCreateOrderTransaction extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_create_order_transaction';

    protected string $toolDescription = 'Create an order Transaction.';

    protected string $method = 'POST';

    protected string $path = '/orders/{order_id}/transactions.json';

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
        'description' => 'Documented order Transaction request body.',
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