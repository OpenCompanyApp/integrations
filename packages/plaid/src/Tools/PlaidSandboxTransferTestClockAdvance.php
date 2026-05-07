<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Advance a test clock.
 *
 * Maps to the official Plaid endpoint post /sandbox/transfer/test_clock/advance.
 */
class PlaidSandboxTransferTestClockAdvance extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_transfer_test_clock_advance';
    protected const DESCRIPTION = 'Advance a test clock

Official Plaid endpoint: POST /sandbox/transfer/test_clock/advance

Use the `/sandbox/transfer/test_clock/advance` endpoint to advance a `test_clock` in the Sandbox environment. A test clock object represents an independent timeline and has a `virtual_time` field indicating the current timestamp of the timeline. A test clock can be advanced by incrementing `virtual_time`, but may never go back to a lower `virtual_time`. If a test clock is advanced, we will simulate the changes that ought to occur during the time that elapsed. For example, a client creates a weekly recurring transfer with a test clock set at t. When the client advances the test clock by setting `virtual_time` = t + 15 days, 2 new originations should be created, along with the webhook event...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/transfer/test_clock/advance';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}