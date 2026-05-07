<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Simulate creating a sweep.
 *
 * Maps to the official Plaid endpoint post /sandbox/transfer/sweep/simulate.
 */
class PlaidSandboxTransferSweepSimulate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_transfer_sweep_simulate';
    protected const DESCRIPTION = 'Simulate creating a sweep

Official Plaid endpoint: POST /sandbox/transfer/sweep/simulate

Use the `/sandbox/transfer/sweep/simulate` endpoint to create a sweep and associated events in the Sandbox environment. Upon calling this endpoint, all transfers with a sweep status of `swept` will become `swept_settled`, all `posted` or `pending` transfers with a sweep status of `unswept` will become `swept`, and all `returned` transfers with a sweep status of `swept` will become `return_swept`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/transfer/sweep/simulate';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}