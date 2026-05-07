<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * List discount codes for a price rule.
 */
class ShopifyListDiscountCodes extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_list_discount_codes';

    protected string $toolDescription = 'List discount codes for a price rule.';

    protected string $method = 'GET';

    protected string $path = '/price_rules/{price_rule_id}/discount_codes.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'price_rule_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Price rule ID.',
    ],
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
];

    /** @var list<string> */
    protected array $required = [
    'price_rule_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'limit',
    'page_info',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}