<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve subscriptions for this account.
 *
 * Executes the official Avalara AvaTax REST API operation ListSubscriptionsByAccount.
 */
class AvalaraListSubscriptionsByAccount extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_subscriptions_by_account';
}