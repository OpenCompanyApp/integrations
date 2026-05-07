<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one Shopify Blog.
 */
class ShopifyGetBlog extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_blog';

    protected string $toolDescription = 'Get one Shopify Blog.';

    protected string $method = 'GET';

    protected string $path = '/blogs/{blog_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'blog_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Blog ID.',
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
    'blog_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'fields',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}