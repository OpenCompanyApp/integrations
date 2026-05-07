<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get a test clock.
 *
 * Maps to the official Plaid endpoint post /sandbox/transfer/test_clock/get.
 */
class PlaidSandboxTransferTestClockGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_transfer_test_clock_get';
    protected const DESCRIPTION = 'Get a test clock

Official Plaid endpoint: POST /sandbox/transfer/test_clock/get

Use the `/sandbox/transfer/test_clock/get` endpoint to get a `test_clock` in the Sandbox environment.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/transfer/test_clock/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}