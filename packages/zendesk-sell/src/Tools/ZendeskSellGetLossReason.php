<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Get a Zendesk Sell loss reason.
 */
class ZendeskSellGetLossReason extends ZendeskSellGetDealSource
{
    protected string $toolName = 'zendesk_sell_get_loss_reason';
    protected string $toolDescription = 'Get a Zendesk Sell loss reason by ID.';
    protected string $path = '/v2/loss_reasons/{id}';
}
