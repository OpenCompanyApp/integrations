<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a discount code.
 */
class ShopifyUpdateDiscountCode extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_discount_code';

    protected string $toolDescription = 'Update a discount code.';

    protected string $method = 'PUT';

    protected string $path = '/price_rules/{price_rule_id}/discount_codes/{discount_code_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'price_rule_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Price rule ID.',
    ],
    'discount_code_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Discount code ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Discount code update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'price_rule_id',
    'discount_code_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}