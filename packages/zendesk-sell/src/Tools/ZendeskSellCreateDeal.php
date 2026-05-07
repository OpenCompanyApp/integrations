<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Create a Zendesk Sell deal.
 */
class ZendeskSellCreateDeal extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_create_deal';
    protected string $toolDescription = 'Create a Zendesk Sell deal.';
    protected string $method = 'POST';
    protected string $path = '/v2/deals';
    protected array $required = ['name'];
    protected array $bodyParams = ['name', 'value', 'currency', 'hot', 'stage_id', 'source_id', 'contact_id', 'organization_id', 'owner_id', 'estimated_close_date', 'customized_win_likelihood', 'tags', 'custom_fields'];
    protected array $parameters = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Deal name.'],
        'value' => ['type' => 'number', 'description' => 'Deal value.'],
        'currency' => ['type' => 'string', 'description' => 'Currency code.'],
        'stage_id' => ['type' => 'integer', 'description' => 'Stage ID.'],
        'contact_id' => ['type' => 'integer', 'description' => 'Primary contact ID.'],
        'organization_id' => ['type' => 'integer', 'description' => 'Organization contact ID.'],
        'owner_id' => ['type' => 'integer', 'description' => 'Owner user ID.'],
        'tags' => ['type' => 'array', 'description' => 'Tags.'],
        'custom_fields' => ['type' => 'object', 'description' => 'Custom field values.'],
    ];
}
