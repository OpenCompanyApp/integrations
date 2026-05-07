<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update an order Transaction.
 */
class ShopifyUpdateOrderTransaction extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_order_transaction';

    protected string $toolDescription = 'Update an order Transaction.';

    protected string $method = 'PUT';

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
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented order Transaction update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'order_id',
    'transaction_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}