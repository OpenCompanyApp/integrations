<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Add Connection Membership.
 *
 * Maps to the official Fivetran endpoint post /v1/teams/{teamId}/connections.
 */
class FivetranAddTeamMembershipInConnection extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_add_team_membership_in_connection';
    protected const DESCRIPTION = 'Add Connection Membership

Official Fivetran endpoint: POST /v1/teams/{teamId}/connections

Adds a team as a member of a connection.';
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
    protected const PATH = '/v1/teams/{teamId}/connections';
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
