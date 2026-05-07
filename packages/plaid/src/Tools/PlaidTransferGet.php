<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve a transfer.
 *
 * Maps to the official Plaid endpoint post /transfer/get.
 */
class PlaidTransferGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_get';
    protected const DESCRIPTION = 'Retrieve a transfer

Official Plaid endpoint: POST /transfer/get

The `/transfer/get` endpoint fetches information about the transfer corresponding to the given `transfer_id` or `authorization_id`. One of `transfer_id` or `authorization_id` must be populated but not both.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}