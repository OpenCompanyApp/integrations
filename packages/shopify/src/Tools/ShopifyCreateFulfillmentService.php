<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Create a Shopify Fulfillment Service.
 */
class ShopifyCreateFulfillmentService extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_create_fulfillment_service';

    protected string $toolDescription = 'Create a Shopify Fulfillment Service.';

    protected string $method = 'POST';

    protected string $path = '/fulfillment_services.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Fulfillment Service request body, usually wrapped under its resource key.',
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