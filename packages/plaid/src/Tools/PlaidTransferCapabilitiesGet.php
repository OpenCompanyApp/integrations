<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get RTP eligibility information of a transfer.
 *
 * Maps to the official Plaid endpoint post /transfer/capabilities/get.
 */
class PlaidTransferCapabilitiesGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_capabilities_get';
    protected const DESCRIPTION = 'Get RTP eligibility information of a transfer

Official Plaid endpoint: POST /transfer/capabilities/get

Use the `/transfer/capabilities/get` endpoint to determine the RTP eligibility information of an account to be used with Transfer. This endpoint works on all Transfer-capable Items, including those created by `/transfer/migrate_account`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/capabilities/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}