<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a Shopify Price Rule.
 */
class ShopifyUpdatePriceRule extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_price_rule';

    protected string $toolDescription = 'Update a Shopify Price Rule.';

    protected string $method = 'PUT';

    protected string $path = '/price_rules/{price_rule_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'price_rule_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Price Rule ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Price Rule update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'price_rule_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}