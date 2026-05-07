<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Update Connection Membership.
 *
 * Maps to the official Fivetran endpoint patch /v1/users/{userId}/connections/{connectionId}.
 */
class FivetranUpdateUserMembershipInConnection extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_update_user_membership_in_connection';
    protected const DESCRIPTION = 'Update Connection Membership

Official Fivetran endpoint: PATCH /v1/users/{userId}/connections/{connectionId}

Updates user membership in a connection.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'patch';
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
