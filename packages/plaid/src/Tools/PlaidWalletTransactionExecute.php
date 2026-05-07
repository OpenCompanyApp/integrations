<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Execute a transaction using an e-wallet.
 *
 * Maps to the official Plaid endpoint post /wallet/transaction/execute.
 */
class PlaidWalletTransactionExecute extends AbstractPlaidTool
{
    protected const NAME = 'plaid_wallet_transaction_execute';
    protected const DESCRIPTION = 'Execute a transaction using an e-wallet

Official Plaid endpoint: POST /wallet/transaction/execute

Execute a transaction using the specified e-wallet. Specify the e-wallet to debit from, the counterparty to credit to, the idempotency key to prevent duplicate transactions, the amount and reference for the transaction. Transactions will settle in seconds to several days, depending on the underlying payment rail.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/wallet/transaction/execute';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}