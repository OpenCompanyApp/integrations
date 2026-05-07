<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Upsert a Zendesk Sell deal using query filters.
 */
class ZendeskSellUpsertDeal extends ZendeskSellCreateDeal
{
    protected string $toolName = 'zendesk_sell_upsert_deal';
    protected string $toolDescription = 'Create or update a Zendesk Sell deal using query filters such as name or custom_fields[external_id].';
    protected string $method = 'POST';
    protected string $path = '/v2/deals/upsert';
    protected array $required = [];
    protected array $queryParams = ['name', 'contact_id', 'organization_id', 'custom_fields'];
}
