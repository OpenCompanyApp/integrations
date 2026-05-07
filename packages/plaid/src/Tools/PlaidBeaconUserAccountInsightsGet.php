<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get Account Insights for a Beacon User.
 *
 * Maps to the official Plaid endpoint post /beacon/user/account_insights/get.
 */
class PlaidBeaconUserAccountInsightsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_beacon_user_account_insights_get';
    protected const DESCRIPTION = 'Get Account Insights for a Beacon User

Official Plaid endpoint: POST /beacon/user/account_insights/get

Get Account Insights for all Accounts linked to this Beacon User. The insights for each account are computed based on the information that was last retrieved from the financial institution.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beacon/user/account_insights/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}