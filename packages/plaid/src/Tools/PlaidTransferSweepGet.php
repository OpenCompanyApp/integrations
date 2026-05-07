<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve a sweep.
 *
 * Maps to the official Plaid endpoint post /transfer/sweep/get.
 */
class PlaidTransferSweepGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_sweep_get';
    protected const DESCRIPTION = 'Retrieve a sweep

Official Plaid endpoint: POST /transfer/sweep/get

The `/transfer/sweep/get` endpoint fetches a sweep corresponding to the given `sweep_id`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/sweep/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}