<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a team.
 *
 * Maps to the official FireHydrant endpoint get /v1/teams/{team_id}.
 */
class FireHydrantGetTeam extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_team';
    protected const DESCRIPTION = 'Get a team

Official FireHydrant endpoint: GET /v1/teams/{team_id}

Retrieve a single team from its ID';
    protected const PARAMETERS = array (
  'team_id' =>
  array (
    'type' => 'string',
    'description' => 'Team UUID or slug',
    'required' => true,
  ),
  'lite' =>
  array (
    'type' => 'boolean',
    'description' => 'Boolean to determine whether to return a slimified version of the teams object',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/teams/{team_id}';
    protected const PATH_PARAMS = array (
  'team_id' => 'team_id',
);
    protected const QUERY_PARAMS = array (
  'lite' => 'lite',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
