<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * List Shopify Script Tags.
 */
class ShopifyListScriptTags extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_list_script_tags';

    protected string $toolDescription = 'List Shopify Script Tags.';

    protected string $method = 'GET';

    protected string $path = '/script_tags.json';

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
    'src' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify src filter when supported.',
    ],
    'fields' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify fields filter when supported.',
    ],
    'ids' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify ids filter when supported.',
    ],
    'since_id' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify since_id filter when supported.',
    ],
];

    /** @var list<string> */
    protected array $required = [];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'limit',
    'page_info',
    'src',
    'fields',
    'ids',
    'since_id',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}