<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Create a Zendesk Sell deal source.
 */
class ZendeskSellCreateDealSource extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_create_deal_source';
    protected string $toolDescription = 'Create a Zendesk Sell deal source.';
    protected string $method = 'POST';
    protected string $path = '/v2/deal_sources';
    protected array $required = ['name'];
    protected array $bodyParams = ['name'];
    protected array $parameters = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Source name.'],
    ];
}
