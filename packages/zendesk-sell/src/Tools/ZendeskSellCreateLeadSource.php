<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Create a Zendesk Sell lead source.
 */
class ZendeskSellCreateLeadSource extends ZendeskSellCreateDealSource
{
    protected string $toolName = 'zendesk_sell_create_lead_source';
    protected string $toolDescription = 'Create a Zendesk Sell lead source.';
    protected string $path = '/v2/lead_sources';
}
