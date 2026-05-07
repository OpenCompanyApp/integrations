<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Get a Zendesk Sell deal source.
 */
class ZendeskSellGetDealSource extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_get_deal_source';
    protected string $toolDescription = 'Get a Zendesk Sell deal source by ID.';
    protected string $path = '/v2/deal_sources/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Deal source ID.'],
    ];
}
