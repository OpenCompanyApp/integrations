<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * List Zendesk Sell pipelines.
 */
class ZendeskSellListPipelines extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_list_pipelines';
    protected string $toolDescription = 'List Zendesk Sell sales pipelines.';
    protected string $path = '/v2/pipelines';
    protected array $queryParams = ['page', 'per_page'];
    protected array $parameters = [
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Records per page, max 100.'],
    ];
}
