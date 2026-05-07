<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete a Shopify Price Rule.
 */
class ShopifyDeletePriceRule extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_price_rule';

    protected string $toolDescription = 'Delete a Shopify Price Rule.';

    protected string $method = 'DELETE';

    protected string $path = '/price_rules/{price_rule_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'price_rule_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Price Rule ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'price_rule_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}