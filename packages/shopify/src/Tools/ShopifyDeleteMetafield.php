<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete a shop-level metafield.
 */
class ShopifyDeleteMetafield extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_metafield';

    protected string $toolDescription = 'Delete a shop-level metafield.';

    protected string $method = 'DELETE';

    protected string $path = '/metafields/{metafield_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'metafield_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Metafield ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'metafield_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}