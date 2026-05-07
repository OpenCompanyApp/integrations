<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Simulate a ledger deposit event in Sandbox.
 *
 * Maps to the official Plaid endpoint post /sandbox/transfer/ledger/deposit/simulate.
 */
class PlaidSandboxTransferLedgerDepositSimulate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_transfer_ledger_deposit_simulate';
    protected const DESCRIPTION = 'Simulate a ledger deposit event in Sandbox

Official Plaid endpoint: POST /sandbox/transfer/ledger/deposit/simulate

Use the `/sandbox/transfer/ledger/deposit/simulate` endpoint to simulate a ledger deposit event in the Sandbox environment.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/transfer/ledger/deposit/simulate';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}