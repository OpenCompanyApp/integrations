<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Subscribe and unsubscribe to proactive notifications for a user's income profile.
 *
 * Maps to the official Plaid endpoint post /credit/bank_income/webhook/update.
 */
class PlaidCreditBankIncomeWebhookUpdate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_bank_income_webhook_update';
    protected const DESCRIPTION = 'Subscribe and unsubscribe to proactive notifications for a user\'s income profile

Official Plaid endpoint: POST /credit/bank_income/webhook/update

`/credit/bank_income/webhook/update` allows you to subscribe or unsubscribe a user for income webhook notifications. By default, all users start out unsubscribed. If a user is subscribed, on significant changes to the user\'s income profile, you will receive a `BANK_INCOME_REFRESH_UPDATE` webhook, prompting you to refresh bank income data for the user.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/bank_income/webhook/update';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}