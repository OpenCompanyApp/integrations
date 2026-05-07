<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a blog article.
 */
class ShopifyUpdateArticle extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_article';

    protected string $toolDescription = 'Update a blog article.';

    protected string $method = 'PUT';

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
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Article update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'blog_id',
    'article_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}