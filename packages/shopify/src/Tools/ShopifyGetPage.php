<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one Shopify Page.
 */
class ShopifyGetPage extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_page';

    protected string $toolDescription = 'Get one Shopify Page.';

    protected string $method = 'GET';

    protected string $path = '/pages/{page_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'page_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Page ID.',
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
    'page_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'fields',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}