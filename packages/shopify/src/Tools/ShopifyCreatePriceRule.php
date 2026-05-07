<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Create a Shopify Price Rule.
 */
class ShopifyCreatePriceRule extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_create_price_rule';

    protected string $toolDescription = 'Create a Shopify Price Rule.';

    protected string $method = 'POST';

    protected string $path = '/price_rules.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Price Rule request body, usually wrapped under its resource key.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}