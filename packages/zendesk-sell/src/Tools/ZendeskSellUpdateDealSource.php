<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Update a Zendesk Sell deal source.
 */
class ZendeskSellUpdateDealSource extends ZendeskSellCreateDealSource
{
    protected string $toolName = 'zendesk_sell_update_deal_source';
    protected string $toolDescription = 'Update a Zendesk Sell deal source by ID.';
    protected string $method = 'PUT';
    protected string $path = '/v2/deal_sources/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Deal source ID.'],
        'name' => ['type' => 'string', 'description' => 'Source name.'],
    ];
}
