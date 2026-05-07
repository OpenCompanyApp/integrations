<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Call any Shopify Admin REST DELETE endpoint path.
 */
class ShopifyApiDelete extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_api_delete';

    protected string $toolDescription = 'Call any Shopify Admin REST DELETE endpoint path.';

    protected string $method = 'DELETE';

    protected string $path = '{path}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'path' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Admin REST path such as /products/{id}.json.',
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
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}