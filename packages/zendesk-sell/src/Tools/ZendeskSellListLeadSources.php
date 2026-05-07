<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * List Zendesk Sell lead sources.
 */
class ZendeskSellListLeadSources extends ZendeskSellListDealSources
{
    protected string $toolName = 'zendesk_sell_list_lead_sources';
    protected string $toolDescription = 'List Zendesk Sell lead sources.';
    protected string $path = '/v2/lead_sources';
}
