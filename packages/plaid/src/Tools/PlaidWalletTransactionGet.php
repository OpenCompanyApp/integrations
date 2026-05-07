<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Fetch an e-wallet transaction.
 *
 * Maps to the official Plaid endpoint post /wallet/transaction/get.
 */
class PlaidWalletTransactionGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_wallet_transaction_get';
    protected const DESCRIPTION = 'Fetch an e-wallet transaction

Official Plaid endpoint: POST /wallet/transaction/get

Fetch a specific e-wallet transaction';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/wallet/transaction/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}