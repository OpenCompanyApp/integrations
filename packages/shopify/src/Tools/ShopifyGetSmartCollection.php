<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one Shopify Smart Collection.
 */
class ShopifyGetSmartCollection extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_smart_collection';

    protected string $toolDescription = 'Get one Shopify Smart Collection.';

    protected string $method = 'GET';

    protected string $path = '/smart_collections/{smart_collection_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'smart_collection_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Smart Collection ID.',
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
    'smart_collection_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'fields',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}