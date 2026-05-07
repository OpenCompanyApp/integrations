<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Connection Membership.
 *
 * Maps to the official Fivetran endpoint get /v1/teams/{teamId}/connections/{connectionId}.
 */
class FivetranGetTeamMembershipInConnection extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_get_team_membership_in_connection';
    protected const DESCRIPTION = 'Retrieve Connection Membership

Official Fivetran endpoint: GET /v1/teams/{teamId}/connections/{connectionId}

Returns details of a team membership in a connection.';
    protected const PARAMETERS = array (
  'team_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `teamId` from the official Fivetran API operation. The unique identifier for the team within the account.',
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
    protected const PATH = '/v1/teams/{teamId}/connections/{connectionId}';
    protected const PATH_PARAMS = array (
  'teamId' => 'team_id',
  'connectionId' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
