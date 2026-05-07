<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete a Shopify Collect.
 */
class ShopifyDeleteCollect extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_collect';

    protected string $toolDescription = 'Delete a Shopify Collect.';

    protected string $method = 'DELETE';

    protected string $path = '/collects/{collect_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'collect_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Collect ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'collect_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}