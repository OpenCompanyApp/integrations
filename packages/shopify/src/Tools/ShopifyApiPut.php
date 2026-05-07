<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Call any Shopify Admin REST PUT endpoint path.
 */
class ShopifyApiPut extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_api_put';

    protected string $toolDescription = 'Call any Shopify Admin REST PUT endpoint path.';

    protected string $method = 'PUT';

    protected string $path = '{path}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'path' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Admin REST path such as /products/{id}.json.',
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