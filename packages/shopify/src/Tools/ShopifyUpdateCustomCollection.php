<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a Shopify Custom Collection.
 */
class ShopifyUpdateCustomCollection extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_custom_collection';

    protected string $toolDescription = 'Update a Shopify Custom Collection.';

    protected string $method = 'PUT';

    protected string $path = '/custom_collections/{custom_collection_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'custom_collection_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Custom Collection ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Custom Collection update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'custom_collection_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}