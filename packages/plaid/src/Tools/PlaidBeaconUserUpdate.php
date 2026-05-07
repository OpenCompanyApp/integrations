<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Update the identity data of a Beacon User.
 *
 * Maps to the official Plaid endpoint post /beacon/user/update.
 */
class PlaidBeaconUserUpdate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_beacon_user_update';
    protected const DESCRIPTION = 'Update the identity data of a Beacon User

Official Plaid endpoint: POST /beacon/user/update

Update the identity data for a Beacon User in your Beacon Program or add new accounts to the Beacon User. Similar to `/beacon/user/create`, several checks are performed immediately when you submit an identity data change to `/beacon/user/update`: - The user\'s updated PII is searched against all other users within the Beacon Program you specified. If a match is found that violates your program\'s "Duplicate Information Filtering" settings, the user will be returned with a status of `pending_review`. - The user\'s updated PII is also searched against all fraud reports created by your organization across all of your Beacon Programs. If the user\'s data matches a fraud report that your team crea...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beacon/user/update';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}