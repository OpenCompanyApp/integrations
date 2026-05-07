<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get a Beacon User.
 *
 * Maps to the official Plaid endpoint post /beacon/user/get.
 */
class PlaidBeaconUserGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_beacon_user_get';
    protected const DESCRIPTION = 'Get a Beacon User

Official Plaid endpoint: POST /beacon/user/get

Fetch a Beacon User. The Beacon User is returned with all of their associated information and a `status` based on the Beacon Network duplicate record and fraud checks.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beacon/user/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}