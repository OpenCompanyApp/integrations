<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List test clocks.
 *
 * Maps to the official Plaid endpoint post /sandbox/transfer/test_clock/list.
 */
class PlaidSandboxTransferTestClockList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_transfer_test_clock_list';
    protected const DESCRIPTION = 'List test clocks

Official Plaid endpoint: POST /sandbox/transfer/test_clock/list

Use the `/sandbox/transfer/test_clock/list` endpoint to see a list of all your test clocks in the Sandbox environment, by ascending `virtual_time`. Results are paginated; use the `count` and `offset` query parameters to retrieve the desired test clocks.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/transfer/test_clock/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}