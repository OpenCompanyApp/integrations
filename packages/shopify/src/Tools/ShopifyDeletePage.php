<?php

namespace OpenCompany\Integrations\Shopify\Tools;

/**
 * Delete a Shopify Page.
 */
class ShopifyDeletePage extends AbstractShopifyRestTool
{
    protected string $toolName = 'shopify_delete_page';

    protected string $toolDescription = 'Delete a Shopify Page.';

    protected string $method = 'DELETE';

    protected string $path = '/pages/{page_id}.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'page_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Shopify Page ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'page_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}