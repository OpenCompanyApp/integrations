<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete a Shopify Fulfillment Service.
 */
class ShopifyDeleteFulfillmentService extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_fulfillment_service';

    protected string $toolDescription = 'Delete a Shopify Fulfillment Service.';

    protected string $method = 'DELETE';

    protected string $path = '/fulfillment_services/{fulfillment_service_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'fulfillment_service_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Fulfillment Service ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'fulfillment_service_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}