<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Check a user's Plaid Network status.
 *
 * Maps to the official Plaid endpoint post /profile/network_status/get.
 */
class PlaidProfileNetworkStatusGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_profile_network_status_get';
    protected const DESCRIPTION = 'Check a user\'s Plaid Network status

Official Plaid endpoint: POST /profile/network_status/get

The `/profile/network_status/get` endpoint can be used to check whether Plaid has a matching profile for the user.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/profile/network_status/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}