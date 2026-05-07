<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one blog article.
 */
class ShopifyGetArticle extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_article';

    protected string $toolDescription = 'Get one blog article.';

    protected string $method = 'GET';

    protected string $path = '/blogs/{blog_id}/articles/{article_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'blog_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Blog ID.',
    ],
    'article_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Article ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'blog_id',
    'article_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}