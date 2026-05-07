<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one shop-level metafield.
 */
class ShopifyGetMetafield extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_metafield';

    protected string $toolDescription = 'Get one shop-level metafield.';

    protected string $method = 'GET';

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