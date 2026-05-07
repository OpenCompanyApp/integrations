<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Update a Zendesk Sell lead source.
 */
class ZendeskSellUpdateLeadSource extends ZendeskSellUpdateDealSource
{
    protected string $toolName = 'zendesk_sell_update_lead_source';
    protected string $toolDescription = 'Update a Zendesk Sell lead source by ID.';
    protected string $path = '/v2/lead_sources/{id}';
}
