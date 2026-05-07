<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Upsert a Zendesk Sell contact using query filters.
 */
class ZendeskSellUpsertContact extends ZendeskSellUpdateContact
{
    protected string $toolName = 'zendesk_sell_upsert_contact';
    protected string $toolDescription = 'Create or update a Zendesk Sell contact using query filters such as email or custom_fields[external_id].';
    protected string $method = 'POST';
    protected string $path = '/v2/contacts/upsert';
    protected array $required = [];
    protected array $queryParams = ['email', 'name', 'first_name', 'last_name', 'custom_fields'];
    protected array $parameters = [
        'email' => ['type' => 'string', 'description' => 'Email filter and optional body value.'],
        'name' => ['type' => 'string', 'description' => 'Organization name filter or body value.'],
        'first_name' => ['type' => 'string', 'description' => 'First name.'],
        'last_name' => ['type' => 'string', 'description' => 'Last name.'],
        'custom_fields' => ['type' => 'object', 'description' => 'Custom field filters or values.'],
        'owner_id' => ['type' => 'integer', 'description' => 'Owner user ID.'],
        'tags' => ['type' => 'array', 'description' => 'Tags.'],
    ];
}
