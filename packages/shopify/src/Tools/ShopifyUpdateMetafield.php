<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a shop-level metafield.
 */
class ShopifyUpdateMetafield extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_metafield';

    protected string $toolDescription = 'Update a shop-level metafield.';

    protected string $method = 'PUT';

    protected string $path = '/metafields/{metafield_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'metafield_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Metafield ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Metafield update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'metafield_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}