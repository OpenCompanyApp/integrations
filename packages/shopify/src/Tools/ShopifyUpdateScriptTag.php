<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a Shopify Script Tag.
 */
class ShopifyUpdateScriptTag extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_script_tag';

    protected string $toolDescription = 'Update a Shopify Script Tag.';

    protected string $method = 'PUT';

    protected string $path = '/script_tags/{script_tag_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'script_tag_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Script Tag ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Script Tag update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'script_tag_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}