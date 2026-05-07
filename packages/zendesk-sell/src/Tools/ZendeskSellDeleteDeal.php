<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Delete a Zendesk Sell deal.
 */
class ZendeskSellDeleteDeal extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_delete_deal';
    protected string $toolDescription = 'Delete a Zendesk Sell deal by ID.';
    protected string $method = 'DELETE';
    protected string $path = '/v2/deals/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Deal ID.'],
    ];
}
