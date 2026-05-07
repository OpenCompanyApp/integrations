<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Delete Connection Membership.
 *
 * Maps to the official Fivetran endpoint delete /v1/users/{userId}/connections/{connectionId}.
 */
class FivetranDeleteUserMembershipInConnection extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_user_membership_in_connection';
    protected const DESCRIPTION = 'Delete Connection Membership

Official Fivetran endpoint: DELETE /v1/users/{userId}/connections/{connectionId}

Removes user membership in a connection.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userId` from the official Fivetran API operation. The unique identifier for the user within the account.',
  ),
  'connection_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `connectionId` from the official Fivetran API operation. The unique identifier for the connection within the Fivetran system.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/users/{userId}/connections/{connectionId}';
    protected const PATH_PARAMS = array (
  'userId' => 'user_id',
  'connectionId' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
