<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get status of an originator's onboarding.
 *
 * Maps to the official Plaid endpoint post /transfer/originator/get.
 */
class PlaidTransferOriginatorGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_originator_get';
    protected const DESCRIPTION = 'Get status of an originator\'s onboarding

Official Plaid endpoint: POST /transfer/originator/get

The `/transfer/originator/get` endpoint gets status updates for an originator\'s onboarding process. This information is also available via the Transfer page on the Plaid dashboard.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/originator/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}