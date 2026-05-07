<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Update the funding account associated with the originator.
 *
 * Maps to the official Plaid endpoint post /transfer/originator/funding_account/update.
 */
class PlaidTransferOriginatorFundingAccountUpdate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_originator_funding_account_update';
    protected const DESCRIPTION = 'Update the funding account associated with the originator

Official Plaid endpoint: POST /transfer/originator/funding_account/update

Use the `/transfer/originator/funding_account/update` endpoint to update the funding account associated with the originator.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/originator/funding_account/update';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}