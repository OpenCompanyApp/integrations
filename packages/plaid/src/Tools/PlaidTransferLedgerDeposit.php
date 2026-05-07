<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Deposit funds into a Plaid Ledger balance.
 *
 * Maps to the official Plaid endpoint post /transfer/ledger/deposit.
 */
class PlaidTransferLedgerDeposit extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_ledger_deposit';
    protected const DESCRIPTION = 'Deposit funds into a Plaid Ledger balance

Official Plaid endpoint: POST /transfer/ledger/deposit

Use the `/transfer/ledger/deposit` endpoint to deposit funds into Plaid Ledger.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/ledger/deposit';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}