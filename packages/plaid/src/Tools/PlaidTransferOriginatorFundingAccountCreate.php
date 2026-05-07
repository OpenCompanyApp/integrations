<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a new funding account for an originator.
 *
 * Maps to the official Plaid endpoint post /transfer/originator/funding_account/create.
 */
class PlaidTransferOriginatorFundingAccountCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_originator_funding_account_create';
    protected const DESCRIPTION = 'Create a new funding account for an originator

Official Plaid endpoint: POST /transfer/originator/funding_account/create

Use the `/transfer/originator/funding_account/create` endpoint to create a new funding account for the originator.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/originator/funding_account/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}