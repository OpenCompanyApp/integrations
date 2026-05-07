<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Team Details.
 *
 * Maps to the official Fivetran endpoint get /v1/teams/{teamId}.
 */
class FivetranTeamDetails extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_team_details';
    protected const DESCRIPTION = 'Retrieve Team Details

Official Fivetran endpoint: GET /v1/teams/{teamId}

Returns information for a given team within your Fivetran account';
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
);
    protected const METHOD = 'get';
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
