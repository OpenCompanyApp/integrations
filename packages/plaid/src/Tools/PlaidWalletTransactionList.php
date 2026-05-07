<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List e-wallet transactions.
 *
 * Maps to the official Plaid endpoint post /wallet/transaction/list.
 */
class PlaidWalletTransactionList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_wallet_transaction_list';
    protected const DESCRIPTION = 'List e-wallet transactions

Official Plaid endpoint: POST /wallet/transaction/list

This endpoint lists the latest transactions of the specified e-wallet. Transactions are returned in descending order by the `created_at` time.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/wallet/transaction/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}