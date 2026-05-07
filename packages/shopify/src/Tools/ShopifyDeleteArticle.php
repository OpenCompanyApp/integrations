<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete a blog article.
 */
class ShopifyDeleteArticle extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_article';

    protected string $toolDescription = 'Delete a blog article.';

    protected string $method = 'DELETE';

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