<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Create a Zendesk Sell lead.
 */
class ZendeskSellCreateLead extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_create_lead';
    protected string $toolDescription = 'Create a Zendesk Sell lead.';
    protected string $method = 'POST';
    protected string $path = '/v2/leads';
    protected array $required = ['last_name'];
    protected array $bodyParams = ['first_name', 'last_name', 'organization_name', 'owner_id', 'source_id', 'title', 'description', 'industry', 'website', 'email', 'phone', 'mobile', 'fax', 'twitter', 'facebook', 'linkedin', 'skype', 'address', 'tags', 'custom_fields'];
    protected array $parameters = [
        'last_name' => ['type' => 'string', 'required' => true, 'description' => 'Lead last name.'],
        'first_name' => ['type' => 'string', 'description' => 'Lead first name.'],
        'organization_name' => ['type' => 'string', 'description' => 'Organization name.'],
        'email' => ['type' => 'string', 'description' => 'Email address.'],
        'phone' => ['type' => 'string', 'description' => 'Phone number.'],
        'owner_id' => ['type' => 'integer', 'description' => 'Owner user ID.'],
        'source_id' => ['type' => 'integer', 'description' => 'Lead source ID.'],
        'tags' => ['type' => 'array', 'description' => 'Tags.'],
        'custom_fields' => ['type' => 'object', 'description' => 'Custom field values.'],
    ];
}
