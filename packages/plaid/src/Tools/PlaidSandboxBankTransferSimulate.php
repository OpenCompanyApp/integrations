<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Simulate a bank transfer event in Sandbox.
 *
 * Maps to the official Plaid endpoint post /sandbox/bank_transfer/simulate.
 */
class PlaidSandboxBankTransferSimulate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_bank_transfer_simulate';
    protected const DESCRIPTION = 'Simulate a bank transfer event in Sandbox

Official Plaid endpoint: POST /sandbox/bank_transfer/simulate

Use the `/sandbox/bank_transfer/simulate` endpoint to simulate a bank transfer event in the Sandbox environment. Note that while an event will be simulated and will appear when using endpoints such as `/bank_transfer/event/sync` or `/bank_transfer/event/list`, no transactions will actually take place and funds will not move between accounts, even within the Sandbox.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/bank_transfer/simulate';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}