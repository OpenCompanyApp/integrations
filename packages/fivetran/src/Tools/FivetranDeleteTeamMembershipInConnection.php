<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Delete Connection Membership.
 *
 * Maps to the official Fivetran endpoint delete /v1/teams/{teamId}/connections/{connectionId}.
 */
class FivetranDeleteTeamMembershipInConnection extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_team_membership_in_connection';
    protected const DESCRIPTION = 'Delete Connection Membership

Official Fivetran endpoint: DELETE /v1/teams/{teamId}/connections/{connectionId}

Removes team membership in a connection.';
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
    protected const METHOD = 'delete';
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
