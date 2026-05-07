<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * List All User Memberships.
 *
 * Maps to the official Fivetran endpoint get /v1/teams/{teamId}/users.
 */
class FivetranListUsersInTeam extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_list_users_in_team';
    protected const DESCRIPTION = 'List All User Memberships

Official Fivetran endpoint: GET /v1/teams/{teamId}/users

Returns a list of users and their roles within a team in your Fivetran account';
    protected const PARAMETERS = array (
  'team_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `teamId` from the official Fivetran API operation. The unique identifier for the team within the account.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Fivetran API operation. Paging cursor, [read more about pagination](https://fivetran.com/docs/rest-api/pagination)',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Fivetran API operation. Number of records to fetch per page. Accepts a number in the range 1..1000; the default value is 100.',
  ),
  'active' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `active` from the official Fivetran API operation. Indicates whether to return only enabled users (true) or not (false). By default, both enabled (allowed to log in) and suspended users ar...',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/teams/{teamId}/users';
    protected const PATH_PARAMS = array (
  'teamId' => 'team_id',
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
  'active' => 'active',
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
