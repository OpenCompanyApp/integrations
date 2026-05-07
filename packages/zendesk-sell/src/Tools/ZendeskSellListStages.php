<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * List Zendesk Sell deal stages.
 */
class ZendeskSellListStages extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_list_stages';
    protected string $toolDescription = 'List Zendesk Sell deal stages.';
    protected string $path = '/v2/stages';
    protected array $queryParams = ['page', 'per_page', 'pipeline_id'];
    protected array $parameters = [
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Records per page, max 100.'],
        'pipeline_id' => ['type' => 'integer', 'description' => 'Pipeline ID filter.'],
    ];
}
