<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete a Shopify Order.
 */
class ShopifyDeleteOrder extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_order';

    protected string $toolDescription = 'Delete a Shopify Order.';

    protected string $method = 'DELETE';

    protected string $path = '/orders/{order_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'order_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Order ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'order_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}