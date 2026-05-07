<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

/**
 * List Zendesk Sell loss reasons.
 */
class ZendeskSellListLossReasons extends ZendeskSellListDealSources
{
    protected string $toolName = 'zendesk_sell_list_loss_reasons';
    protected string $toolDescription = 'List Zendesk Sell deal loss reasons.';
    protected string $path = '/v2/loss_reasons';
}
