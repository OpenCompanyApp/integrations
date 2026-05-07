<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * List Zendesk Sell users.
 */
class ZendeskSellListUsers extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_list_users';
    protected string $toolDescription = 'List Zendesk Sell users.';
    protected string $path = '/v2/users';
    protected array $queryParams = ['page', 'per_page', 'ids', 'email'];
    protected array $parameters = [
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Records per page, max 100.'],
        'email' => ['type' => 'string', 'description' => 'Email filter.'],
    ];
}
