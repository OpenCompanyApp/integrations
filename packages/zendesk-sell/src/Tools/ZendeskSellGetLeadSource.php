<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Get a Zendesk Sell lead source.
 */
class ZendeskSellGetLeadSource extends ZendeskSellGetDealSource
{
    protected string $toolName = 'zendesk_sell_get_lead_source';
    protected string $toolDescription = 'Get a Zendesk Sell lead source by ID.';
    protected string $path = '/v2/lead_sources/{id}';
}
