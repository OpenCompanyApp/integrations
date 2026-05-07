<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete a Shopify Smart Collection.
 */
class ShopifyDeleteSmartCollection extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_smart_collection';

    protected string $toolDescription = 'Delete a Shopify Smart Collection.';

    protected string $method = 'DELETE';

    protected string $path = '/smart_collections/{smart_collection_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'smart_collection_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Smart Collection ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'smart_collection_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}