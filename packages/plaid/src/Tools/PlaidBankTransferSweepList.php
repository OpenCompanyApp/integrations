<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List sweeps.
 *
 * Maps to the official Plaid endpoint post /bank_transfer/sweep/list.
 */
class PlaidBankTransferSweepList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_bank_transfer_sweep_list';
    protected const DESCRIPTION = 'List sweeps

Official Plaid endpoint: POST /bank_transfer/sweep/list

The `/bank_transfer/sweep/list` endpoint fetches information about the sweeps matching the given filters.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/bank_transfer/sweep/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}