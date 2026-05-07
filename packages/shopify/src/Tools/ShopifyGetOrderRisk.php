<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one order Risk.
 */
class ShopifyGetOrderRisk extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_order_risk';

    protected string $toolDescription = 'Get one order Risk.';

    protected string $method = 'GET';

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
];

    /** @var list<string> */
    protected array $required = [
    'order_id',
    'risk_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}