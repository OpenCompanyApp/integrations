<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Delete a Zendesk Sell loss reason.
 */
class ZendeskSellDeleteLossReason extends ZendeskSellDeleteDealSource
{
    protected string $toolName = 'zendesk_sell_delete_loss_reason';
    protected string $toolDescription = 'Delete a Zendesk Sell loss reason by ID.';
    protected string $path = '/v2/loss_reasons/{id}';
}
