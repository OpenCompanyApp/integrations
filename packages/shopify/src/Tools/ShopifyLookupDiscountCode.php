<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Look up a discount code by code string.
 */
class ShopifyLookupDiscountCode extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_lookup_discount_code';

    protected string $toolDescription = 'Look up a discount code by code string.';

    protected string $method = 'GET';

    protected string $path = '/discount_codes/lookup.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'code' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Discount code string.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional query parameters.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'code',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'code',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}