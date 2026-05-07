<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Update a Zendesk Sell loss reason.
 */
class ZendeskSellUpdateLossReason extends ZendeskSellUpdateDealSource
{
    protected string $toolName = 'zendesk_sell_update_loss_reason';
    protected string $toolDescription = 'Update a Zendesk Sell loss reason by ID.';
    protected string $path = '/v2/loss_reasons/{id}';
}
