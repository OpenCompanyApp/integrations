<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Create an order Risk.
 */
class ShopifyCreateOrderRisk extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_create_order_risk';

    protected string $toolDescription = 'Create an order Risk.';

    protected string $method = 'POST';

    protected string $path = '/orders/{order_id}/risks.json';

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
        'description' => 'Documented order Risk request body.',
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