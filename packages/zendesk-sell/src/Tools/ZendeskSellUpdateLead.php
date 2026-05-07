<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Update a Zendesk Sell lead.
 */
class ZendeskSellUpdateLead extends ZendeskSellCreateLead
{
    protected string $toolName = 'zendesk_sell_update_lead';
    protected string $toolDescription = 'Update a Zendesk Sell lead by ID.';
    protected string $method = 'PUT';
    protected string $path = '/v2/leads/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Lead ID.'],
        'last_name' => ['type' => 'string', 'description' => 'Lead last name.'],
        'first_name' => ['type' => 'string', 'description' => 'Lead first name.'],
        'organization_name' => ['type' => 'string', 'description' => 'Organization name.'],
        'email' => ['type' => 'string', 'description' => 'Email address.'],
        'owner_id' => ['type' => 'integer', 'description' => 'Owner user ID.'],
        'source_id' => ['type' => 'integer', 'description' => 'Lead source ID.'],
        'tags' => ['type' => 'array', 'description' => 'Complete tag set for the lead.'],
        'custom_fields' => ['type' => 'object', 'description' => 'Custom field values.'],
    ];
}
