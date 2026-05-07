<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve User Membership in a Team.
 *
 * Maps to the official Fivetran endpoint get /v1/teams/{teamId}/users/{userId}.
 */
class FivetranGetUserInTeam extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_get_user_in_team';
    protected const DESCRIPTION = 'Retrieve User Membership in a Team

Official Fivetran endpoint: GET /v1/teams/{teamId}/users/{userId}

Returns the membership details for a user in a team.';
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
);
    protected const METHOD = 'get';
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
