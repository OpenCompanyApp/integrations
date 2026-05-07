<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Update a Zendesk Sell deal.
 */
class ZendeskSellUpdateDeal extends ZendeskSellCreateDeal
{
    protected string $toolName = 'zendesk_sell_update_deal';
    protected string $toolDescription = 'Update a Zendesk Sell deal by ID.';
    protected string $method = 'PUT';
    protected string $path = '/v2/deals/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Deal ID.'],
        'name' => ['type' => 'string', 'description' => 'Deal name.'],
        'value' => ['type' => 'number', 'description' => 'Deal value.'],
        'currency' => ['type' => 'string', 'description' => 'Currency code.'],
        'stage_id' => ['type' => 'integer', 'description' => 'Stage ID.'],
        'contact_id' => ['type' => 'integer', 'description' => 'Primary contact ID.'],
        'owner_id' => ['type' => 'integer', 'description' => 'Owner user ID.'],
        'tags' => ['type' => 'array', 'description' => 'Complete tag set for the deal.'],
        'custom_fields' => ['type' => 'object', 'description' => 'Custom field values.'],
    ];
}
