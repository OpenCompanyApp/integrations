<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Simulate a ledger withdraw event in Sandbox.
 *
 * Maps to the official Plaid endpoint post /sandbox/transfer/ledger/withdraw/simulate.
 */
class PlaidSandboxTransferLedgerWithdrawSimulate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_transfer_ledger_withdraw_simulate';
    protected const DESCRIPTION = 'Simulate a ledger withdraw event in Sandbox

Official Plaid endpoint: POST /sandbox/transfer/ledger/withdraw/simulate

Use the `/sandbox/transfer/ledger/withdraw/simulate` endpoint to simulate a ledger withdraw event in the Sandbox environment.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/transfer/ledger/withdraw/simulate';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}