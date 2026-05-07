<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a Shopify Blog.
 */
class ShopifyUpdateBlog extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_blog';

    protected string $toolDescription = 'Update a Shopify Blog.';

    protected string $method = 'PUT';

    protected string $path = '/blogs/{blog_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'blog_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Blog ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Blog update body.',
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