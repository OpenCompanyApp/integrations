<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get status of all originators' onboarding.
 *
 * Maps to the official Plaid endpoint post /transfer/originator/list.
 */
class PlaidTransferOriginatorList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_originator_list';
    protected const DESCRIPTION = 'Get status of all originators\' onboarding

Official Plaid endpoint: POST /transfer/originator/list

The `/transfer/originator/list` endpoint gets status updates for all of your originators\' onboarding. This information is also available via the Plaid dashboard.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/originator/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}