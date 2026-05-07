<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Create a Shopify Smart Collection.
 */
class ShopifyCreateSmartCollection extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_create_smart_collection';

    protected string $toolDescription = 'Create a Shopify Smart Collection.';

    protected string $method = 'POST';

    protected string $path = '/smart_collections.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Smart Collection request body, usually wrapped under its resource key.',
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