<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Simulate converting pending balance to available balance.
 *
 * Maps to the official Plaid endpoint post /sandbox/transfer/ledger/simulate_available.
 */
class PlaidSandboxTransferLedgerSimulateAvailable extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_transfer_ledger_simulate_available';
    protected const DESCRIPTION = 'Simulate converting pending balance to available balance

Official Plaid endpoint: POST /sandbox/transfer/ledger/simulate_available

Use the `/sandbox/transfer/ledger/simulate_available` endpoint to simulate converting pending balance to available balance for all originators in the Sandbox environment.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/transfer/ledger/simulate_available';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}