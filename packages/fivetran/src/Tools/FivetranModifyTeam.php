<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Update a Team.
 *
 * Maps to the official Fivetran endpoint patch /v1/teams/{teamId}.
 */
class FivetranModifyTeam extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_modify_team';
    protected const DESCRIPTION = 'Update a Team

Official Fivetran endpoint: PATCH /v1/teams/{teamId}

Updates information for an existing team within your Fivetran account';
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
    protected const METHOD = 'patch';
    protected const PATH = '/v1/teams/{teamId}';
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
