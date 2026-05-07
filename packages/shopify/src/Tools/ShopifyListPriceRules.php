<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * List Shopify Price Rules.
 */
class ShopifyListPriceRules extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_list_price_rules';

    protected string $toolDescription = 'List Shopify Price Rules.';

    protected string $method = 'GET';

    protected string $path = '/price_rules.json';

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
    'starts_at_min' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify starts_at_min filter when supported.',
    ],
    'ends_at_min' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify ends_at_min filter when supported.',
    ],
    'times_used' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Shopify times_used filter when supported.',
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
    'starts_at_min',
    'ends_at_min',
    'times_used',
    'fields',
    'ids',
    'since_id',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}