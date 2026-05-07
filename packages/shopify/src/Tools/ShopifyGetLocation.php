<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Get one Shopify Location.
 */
class ShopifyGetLocation extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_get_location';

    protected string $toolDescription = 'Get one Shopify Location.';

    protected string $method = 'GET';

    protected string $path = '/locations/{location_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'location_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Location ID.',
    ],
    'fields' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Comma-separated fields to return.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented query parameters.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'location_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'fields',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}