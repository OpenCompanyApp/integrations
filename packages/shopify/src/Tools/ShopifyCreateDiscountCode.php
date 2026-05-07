<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Create a discount code for a price rule.
 */
class ShopifyCreateDiscountCode extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_create_discount_code';

    protected string $toolDescription = 'Create a discount code for a price rule.';

    protected string $method = 'POST';

    protected string $path = '/price_rules/{price_rule_id}/discount_codes.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'price_rule_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Price rule ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Discount code request body.',
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