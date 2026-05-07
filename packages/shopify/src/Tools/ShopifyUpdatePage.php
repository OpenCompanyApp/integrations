<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Update a Shopify Page.
 */
class ShopifyUpdatePage extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_update_page';

    protected string $toolDescription = 'Update a Shopify Page.';

    protected string $method = 'PUT';

    protected string $path = '/pages/{page_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'page_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Page ID.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Documented Shopify Page update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'page_id',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}