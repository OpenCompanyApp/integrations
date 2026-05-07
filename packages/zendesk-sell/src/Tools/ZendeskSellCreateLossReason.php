<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * Create a Zendesk Sell loss reason.
 */
class ZendeskSellCreateLossReason extends ZendeskSellCreateDealSource
{
    protected string $toolName = 'zendesk_sell_create_loss_reason';
    protected string $toolDescription = 'Create a Zendesk Sell loss reason.';
    protected string $path = '/v2/loss_reasons';
}
