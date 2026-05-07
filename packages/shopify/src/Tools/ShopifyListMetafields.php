<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * List shop-level metafields.
 */
class ShopifyListMetafields extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_list_metafields';

    protected string $toolDescription = 'List shop-level metafields.';

    protected string $method = 'GET';

    protected string $path = '/metafields.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
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
    'namespace' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Metafield namespace.',
    ],
    'key' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Metafield key.',
    ],
];

    /** @var list<string> */
    protected array $required = [];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'limit',
    'page_info',
    'namespace',
    'key',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}