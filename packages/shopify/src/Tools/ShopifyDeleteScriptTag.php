<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete a Shopify Script Tag.
 */
class ShopifyDeleteScriptTag extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_script_tag';

    protected string $toolDescription = 'Delete a Shopify Script Tag.';

    protected string $method = 'DELETE';

    protected string $path = '/script_tags/{script_tag_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'script_tag_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Script Tag ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'script_tag_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}