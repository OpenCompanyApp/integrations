<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a test clock.
 *
 * Maps to the official Plaid endpoint post /sandbox/transfer/test_clock/create.
 */
class PlaidSandboxTransferTestClockCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_transfer_test_clock_create';
    protected const DESCRIPTION = 'Create a test clock

Official Plaid endpoint: POST /sandbox/transfer/test_clock/create

Use the `/sandbox/transfer/test_clock/create` endpoint to create a `test_clock` in the Sandbox environment. A test clock object represents an independent timeline and has a `virtual_time` field indicating the current timestamp of the timeline. Test clocks are used for testing recurring transfers in Sandbox. A test clock can be associated with up to 5 recurring transfers.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/transfer/test_clock/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}