<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one Shopify Fulfillment Service.
 */
class ShopifyGetFulfillmentService extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_fulfillment_service';

    protected string $toolDescription = 'Get one Shopify Fulfillment Service.';

    protected string $method = 'GET';

    protected string $path = '/fulfillment_services/{fulfillment_service_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'fulfillment_service_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Fulfillment Service ID.',
    ],
    'fields' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Comma-separated fields to return.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented query parameters.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'fulfillment_service_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'fields',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}