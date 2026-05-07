<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete an order Risk.
 */
class ShopifyDeleteOrderRisk extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_order_risk';

    protected string $toolDescription = 'Delete an order Risk.';

    protected string $method = 'DELETE';

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