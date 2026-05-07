<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one Shopify Collect.
 */
class ShopifyGetCollect extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_collect';

    protected string $toolDescription = 'Get one Shopify Collect.';

    protected string $method = 'GET';

    protected string $path = '/collects/{collect_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'collect_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Collect ID.',
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
    'collect_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'fields',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}