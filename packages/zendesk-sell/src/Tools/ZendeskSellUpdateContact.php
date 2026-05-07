<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Update a Zendesk Sell contact.
 */
class ZendeskSellUpdateContact extends AbstractZendeskSellEndpointTool
{
    protected string $toolName = 'zendesk_sell_update_contact';
    protected string $toolDescription = 'Update a Zendesk Sell contact by ID.';
    protected string $method = 'PUT';
    protected string $path = '/v2/contacts/{id}';
    protected array $required = ['id'];
    protected array $bodyParams = ['name', 'first_name', 'last_name', 'contact_id', 'parent_organization_id', 'owner_id', 'customer_status', 'prospect_status', 'title', 'description', 'industry', 'website', 'email', 'phone', 'mobile', 'fax', 'twitter', 'facebook', 'linkedin', 'skype', 'address', 'billing_address', 'shipping_address', 'tags', 'custom_fields'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Contact ID.'],
        'first_name' => ['type' => 'string', 'description' => 'First name for an individual contact.'],
        'last_name' => ['type' => 'string', 'description' => 'Last name for an individual contact.'],
        'name' => ['type' => 'string', 'description' => 'Name for an organization contact.'],
        'email' => ['type' => 'string', 'description' => 'Email address.'],
        'phone' => ['type' => 'string', 'description' => 'Phone number.'],
        'contact_id' => ['type' => 'integer', 'description' => 'Organization contact ID for an individual.'],
        'owner_id' => ['type' => 'integer', 'description' => 'Owner user ID.'],
        'tags' => ['type' => 'array', 'description' => 'Complete tag set for the contact.'],
        'custom_fields' => ['type' => 'object', 'description' => 'Custom field values.'],
    ];
}
