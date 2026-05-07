<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Delete a Zendesk Sell lead source.
 */
class ZendeskSellDeleteLeadSource extends ZendeskSellDeleteDealSource
{
    protected string $toolName = 'zendesk_sell_delete_lead_source';
    protected string $toolDescription = 'Delete a Zendesk Sell lead source by ID.';
    protected string $path = '/v2/lead_sources/{id}';
}
