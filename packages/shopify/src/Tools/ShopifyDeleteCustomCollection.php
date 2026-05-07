<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete a Shopify Custom Collection.
 */
class ShopifyDeleteCustomCollection extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_custom_collection';

    protected string $toolDescription = 'Delete a Shopify Custom Collection.';

    protected string $method = 'DELETE';

    protected string $path = '/custom_collections/{custom_collection_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'custom_collection_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Custom Collection ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'custom_collection_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}