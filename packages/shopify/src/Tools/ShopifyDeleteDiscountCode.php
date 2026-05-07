<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete a discount code.
 */
class ShopifyDeleteDiscountCode extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_discount_code';

    protected string $toolDescription = 'Delete a discount code.';

    protected string $method = 'DELETE';

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
];

    /** @var list<string> */
    protected array $required = [
    'price_rule_id',
    'discount_code_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}