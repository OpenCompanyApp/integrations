<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Create a Shopify Collect.
 */
class ShopifyCreateCollect extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_create_collect';

    protected string $toolDescription = 'Create a Shopify Collect.';

    protected string $method = 'POST';

    protected string $path = '/collects.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Collect request body, usually wrapped under its resource key.',
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