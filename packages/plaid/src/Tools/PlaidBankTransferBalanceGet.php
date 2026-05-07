<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get balance of your Bank Transfer account.
 *
 * Maps to the official Plaid endpoint post /bank_transfer/balance/get.
 */
class PlaidBankTransferBalanceGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_bank_transfer_balance_get';
    protected const DESCRIPTION = 'Get balance of your Bank Transfer account

Official Plaid endpoint: POST /bank_transfer/balance/get

Use the `/bank_transfer/balance/get` endpoint to see the available balance in your bank transfer account. Debit transfers increase this balance once their status is posted. Credit transfers decrease this balance when they are created. The transactable balance shows the amount in your account that you are able to use for transfers, and is essentially your available balance minus your minimum balance. Note that this endpoint can only be used with FBO accounts, when using Bank Transfers in the Full Service configuration. It cannot be used on your own account when using Bank Transfers in the BTS Platform configuration.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/bank_transfer/balance/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}