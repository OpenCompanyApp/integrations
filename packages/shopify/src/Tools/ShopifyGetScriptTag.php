<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one Shopify Script Tag.
 */
class ShopifyGetScriptTag extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_script_tag';

    protected string $toolDescription = 'Get one Shopify Script Tag.';

    protected string $method = 'GET';

    protected string $path = '/script_tags/{script_tag_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'script_tag_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Script Tag ID.',
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
    'script_tag_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'fields',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}