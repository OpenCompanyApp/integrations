<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one Shopify Custom Collection.
 */
class ShopifyGetCustomCollection extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_custom_collection';

    protected string $toolDescription = 'Get one Shopify Custom Collection.';

    protected string $method = 'GET';

    protected string $path = '/custom_collections/{custom_collection_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'custom_collection_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Custom Collection ID.',
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
    'custom_collection_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'fields',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}