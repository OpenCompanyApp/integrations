<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Delete Account Role.
 *
 * Maps to the official Fivetran endpoint delete /v1/users/{userId}/role.
 */
class FivetranDeleteUserMembershipInAccount extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_user_membership_in_account';
    protected const DESCRIPTION = 'Delete Account Role

Official Fivetran endpoint: DELETE /v1/users/{userId}/role

Removes a user\'s role from an account, but the user remains a member of the account.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userId` from the official Fivetran API operation. The unique identifier for the user within the account.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/users/{userId}/role';
    protected const PATH_PARAMS = array (
  'userId' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
