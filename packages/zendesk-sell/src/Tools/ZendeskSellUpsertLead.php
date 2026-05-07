<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Upsert a Zendesk Sell lead using query filters.
 */
class ZendeskSellUpsertLead extends ZendeskSellCreateLead
{
    protected string $toolName = 'zendesk_sell_upsert_lead';
    protected string $toolDescription = 'Create or update a Zendesk Sell lead using query filters such as email or custom_fields[external_id].';
    protected string $method = 'POST';
    protected string $path = '/v2/leads/upsert';
    protected array $required = [];
    protected array $queryParams = ['email', 'organization_name', 'first_name', 'last_name', 'custom_fields'];
}
