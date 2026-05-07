<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * List Zendesk Sell products.
 */
class ZendeskSellListProducts extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_list_products';
    protected string $toolDescription = 'List Zendesk Sell products.';
    protected string $path = '/v2/products';
    protected array $queryParams = ['page', 'per_page', 'sort_by', 'ids', 'name'];
    protected array $parameters = [
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Records per page, max 100.'],
        'sort_by' => ['type' => 'string', 'description' => 'Sort field.'],
        'name' => ['type' => 'string', 'description' => 'Product name filter.'],
    ];
}
