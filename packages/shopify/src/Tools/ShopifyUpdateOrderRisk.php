<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update an order Risk.
 */
class ShopifyUpdateOrderRisk extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_order_risk';

    protected string $toolDescription = 'Update an order Risk.';

    protected string $method = 'PUT';

    protected string $path = '/orders/{order_id}/risks/{risk_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'order_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify order ID.',
    ],
    'risk_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Risk ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented order Risk update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'order_id',
    'risk_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}