<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Delete a Zendesk Sell lead.
 */
class ZendeskSellDeleteLead extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_delete_lead';
    protected string $toolDescription = 'Delete a Zendesk Sell lead by ID.';
    protected string $method = 'DELETE';
    protected string $path = '/v2/leads/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Lead ID.'],
    ];
}
