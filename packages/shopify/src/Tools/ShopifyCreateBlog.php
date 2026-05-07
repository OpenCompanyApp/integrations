<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Create a Shopify Blog.
 */
class ShopifyCreateBlog extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_create_blog';

    protected string $toolDescription = 'Create a Shopify Blog.';

    protected string $method = 'POST';

    protected string $path = '/blogs.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Blog request body, usually wrapped under its resource key.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}