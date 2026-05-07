<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Simulate a refund event in Sandbox.
 *
 * Maps to the official Plaid endpoint post /sandbox/transfer/refund/simulate.
 */
class PlaidSandboxTransferRefundSimulate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_transfer_refund_simulate';
    protected const DESCRIPTION = 'Simulate a refund event in Sandbox

Official Plaid endpoint: POST /sandbox/transfer/refund/simulate

Use the `/sandbox/transfer/refund/simulate` endpoint to simulate a refund event in the Sandbox environment. Note that while an event will be simulated and will appear when using endpoints such as `/transfer/event/sync` or `/transfer/event/list`, no transactions will actually take place and funds will not move between accounts, even within the Sandbox.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/transfer/refund/simulate';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}