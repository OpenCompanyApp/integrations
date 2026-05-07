<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * List articles for a blog.
 */
class ShopifyListArticles extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_list_articles';

    protected string $toolDescription = 'List articles for a blog.';

    protected string $method = 'GET';

    protected string $path = '/blogs/{blog_id}/articles.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'blog_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Blog ID.',
    ],
    'limit' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Maximum number of records to return.',
    ],
    'page_info' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Cursor pagination token from Shopify Link headers.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Shopify query parameters to pass through.',
    ],
    'published_status' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Published status filter.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'blog_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'limit',
    'page_info',
    'published_status',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}