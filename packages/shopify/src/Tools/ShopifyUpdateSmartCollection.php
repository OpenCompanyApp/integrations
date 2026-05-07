<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a Shopify Smart Collection.
 */
class ShopifyUpdateSmartCollection extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_smart_collection';

    protected string $toolDescription = 'Update a Shopify Smart Collection.';

    protected string $method = 'PUT';

    protected string $path = '/smart_collections/{smart_collection_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'smart_collection_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Smart Collection ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Smart Collection update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'smart_collection_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}