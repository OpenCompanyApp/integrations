<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Update a User Membership.
 *
 * Maps to the official Fivetran endpoint patch /v1/teams/{teamId}/users/{userId}.
 */
class FivetranUpdateUserMembership extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_update_user_membership';
    protected const DESCRIPTION = 'Update a User Membership

Official Fivetran endpoint: PATCH /v1/teams/{teamId}/users/{userId}

Updates a user membership in a team.';
    protected const PARAMETERS = array (
  'team_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `teamId` from the official Fivetran API operation. The unique identifier for the team within the account.',
  ),
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/teams/{teamId}/users/{userId}';
    protected const PATH_PARAMS = array (
  'teamId' => 'team_id',
  'userId' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
