<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * List All Connection Memberships.
 *
 * Maps to the official Fivetran endpoint get /v1/teams/{teamId}/connections.
 */
class FivetranGetTeamMembershipsInConnections extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_get_team_memberships_in_connections';
    protected const DESCRIPTION = 'List All Connection Memberships

Official Fivetran endpoint: GET /v1/teams/{teamId}/connections

Returns all connections a team has membership in.';
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
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/teams/{teamId}/connections';
    protected const PATH_PARAMS = array (
  'teamId' => 'team_id',
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
