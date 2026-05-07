<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Create a Shopify Script Tag.
 */
class ShopifyCreateScriptTag extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_create_script_tag';

    protected string $toolDescription = 'Create a Shopify Script Tag.';

    protected string $method = 'POST';

    protected string $path = '/script_tags.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Script Tag request body, usually wrapped under its resource key.',
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