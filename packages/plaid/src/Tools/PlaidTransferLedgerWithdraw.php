<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Withdraw funds from a Plaid Ledger balance.
 *
 * Maps to the official Plaid endpoint post /transfer/ledger/withdraw.
 */
class PlaidTransferLedgerWithdraw extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_ledger_withdraw';
    protected const DESCRIPTION = 'Withdraw funds from a Plaid Ledger balance

Official Plaid endpoint: POST /transfer/ledger/withdraw

Use the `/transfer/ledger/withdraw` endpoint to withdraw funds from a Plaid Ledger balance.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/ledger/withdraw';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}