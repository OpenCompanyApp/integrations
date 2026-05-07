<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Connection Membership.
 *
 * Maps to the official Fivetran endpoint get /v1/users/{userId}/connections/{connectionId}.
 */
class FivetranGetUserMembershipInConnections extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_get_user_membership_in_connections';
    protected const DESCRIPTION = 'Retrieve Connection Membership

Official Fivetran endpoint: GET /v1/users/{userId}/connections/{connectionId}

Returns the details of a user\'s membership in a connection.';
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
    protected const METHOD = 'get';
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
