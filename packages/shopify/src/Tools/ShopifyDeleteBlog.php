<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete a Shopify Blog.
 */
class ShopifyDeleteBlog extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_blog';

    protected string $toolDescription = 'Delete a Shopify Blog.';

    protected string $method = 'DELETE';

    protected string $path = '/blogs/{blog_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'blog_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Blog ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'blog_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}