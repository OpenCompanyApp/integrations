<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Call any Shopify Admin REST POST endpoint path.
 */
class ShopifyApiPost extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_api_post';

    protected string $toolDescription = 'Call any Shopify Admin REST POST endpoint path.';

    protected string $method = 'POST';

    protected string $path = '{path}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'path' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Admin REST path such as /products.json.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'JSON request body.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Query parameters.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'path',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}