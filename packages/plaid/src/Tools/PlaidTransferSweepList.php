<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List sweeps.
 *
 * Maps to the official Plaid endpoint post /transfer/sweep/list.
 */
class PlaidTransferSweepList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_sweep_list';
    protected const DESCRIPTION = 'List sweeps

Official Plaid endpoint: POST /transfer/sweep/list

The `/transfer/sweep/list` endpoint fetches sweeps matching the given filters.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/sweep/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}