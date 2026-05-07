<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Create a blog article.
 */
class ShopifyCreateArticle extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_create_article';

    protected string $toolDescription = 'Create a blog article.';

    protected string $method = 'POST';

    protected string $path = '/blogs/{blog_id}/articles.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'blog_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Blog ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Article request body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'blog_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}