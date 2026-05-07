<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve a sweep.
 *
 * Maps to the official Plaid endpoint post /bank_transfer/sweep/get.
 */
class PlaidBankTransferSweepGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_bank_transfer_sweep_get';
    protected const DESCRIPTION = 'Retrieve a sweep

Official Plaid endpoint: POST /bank_transfer/sweep/get

The `/bank_transfer/sweep/get` endpoint fetches information about the sweep corresponding to the given `sweep_id`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/bank_transfer/sweep/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}