<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Get a Zendesk Sell lead.
 */
class ZendeskSellGetLead extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_get_lead';
    protected string $toolDescription = 'Get a Zendesk Sell lead by ID.';
    protected string $path = '/v2/leads/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Lead ID.'],
    ];
}
