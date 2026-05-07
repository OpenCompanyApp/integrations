<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a Beacon User.
 *
 * Maps to the official Plaid endpoint post /beacon/user/create.
 */
class PlaidBeaconUserCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_beacon_user_create';
    protected const DESCRIPTION = 'Create a Beacon User

Official Plaid endpoint: POST /beacon/user/create

Create and scan a Beacon User against your Beacon Program, according to your program\'s settings. When you submit a new user to `/beacon/user/create`, several checks are performed immediately: - The user\'s PII (provided within the `user` object) is searched against all other users within the Beacon Program you specified. If a match is found that violates your program\'s "Duplicate Information Filtering" settings, the user will be returned with a status of `pending_review`. - The user\'s PII is also searched against all fraud reports created by your organization across all of your Beacon Programs. If the user\'s data matches a fraud report that your team created, the user will be returned with...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beacon/user/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}