<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a Shopify Fulfillment Service.
 */
class ShopifyUpdateFulfillmentService extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_fulfillment_service';

    protected string $toolDescription = 'Update a Shopify Fulfillment Service.';

    protected string $method = 'PUT';

    protected string $path = '/fulfillment_services/{fulfillment_service_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'fulfillment_service_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Fulfillment Service ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Fulfillment Service update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'fulfillment_service_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}