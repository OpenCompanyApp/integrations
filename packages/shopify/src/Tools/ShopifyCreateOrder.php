<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Create a Shopify Order.
 */
class ShopifyCreateOrder extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_create_order';

    protected string $toolDescription = 'Create a Shopify Order.';

    protected string $method = 'POST';

    protected string $path = '/orders.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Order request body, usually wrapped under its resource key.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}