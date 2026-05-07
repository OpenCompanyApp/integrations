<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Add a User to the Team.
 *
 * Maps to the official Fivetran endpoint post /v1/teams/{teamId}/users.
 */
class FivetranAddUserToTeam extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_add_user_to_team';
    protected const DESCRIPTION = 'Add a User to the Team

Official Fivetran endpoint: POST /v1/teams/{teamId}/users

Assigns a role for a user in a team.';
    protected const PARAMETERS = array (
  'team_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `teamId` from the official Fivetran API operation. The unique identifier for the team within the account.',
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
    protected const METHOD = 'post';
    protected const PATH = '/v1/teams/{teamId}/users';
    protected const PATH_PARAMS = array (
  'teamId' => 'team_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
