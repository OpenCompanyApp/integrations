<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * List Zendesk Sell deal sources.
 */
class ZendeskSellListDealSources extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_list_deal_sources';
    protected string $toolDescription = 'List Zendesk Sell deal sources.';
    protected string $path = '/v2/deal_sources';
    protected array $queryParams = ['page', 'per_page'];
    protected array $parameters = [
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Records per page, max 100.'],
    ];
}
