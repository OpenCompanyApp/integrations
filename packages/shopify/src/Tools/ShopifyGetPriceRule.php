<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one Shopify Price Rule.
 */
class ShopifyGetPriceRule extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_price_rule';

    protected string $toolDescription = 'Get one Shopify Price Rule.';

    protected string $method = 'GET';

    protected string $path = '/price_rules/{price_rule_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'price_rule_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Price Rule ID.',
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
    'price_rule_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'fields',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}