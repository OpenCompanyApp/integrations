<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a Shopify Collect.
 */
class ShopifyUpdateCollect extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_collect';

    protected string $toolDescription = 'Update a Shopify Collect.';

    protected string $method = 'PUT';

    protected string $path = '/collects/{collect_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'collect_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Collect ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Collect update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'collect_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}