<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * List Refunds for a Shopify order.
 */
class ShopifyListOrderRefunds extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_list_order_refunds';

    protected string $toolDescription = 'List Refunds for a Shopify order.';

    protected string $method = 'GET';

    protected string $path = '/orders/{order_id}/refunds.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'order_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify order ID.',
    ],
    'limit' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Maximum number of records to return.',
    ],
    'page_info' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Cursor pagination token from Shopify Link headers.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Shopify query parameters to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'order_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'limit',
    'page_info',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}