<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List call routes for a team.
 *
 * Maps to the official FireHydrant endpoint get /v1/teams/{team_id}/call_routes.
 */
class FireHydrantListTeamCallRoutes extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_team_call_routes';
    protected const DESCRIPTION = 'List call routes for a team

Official FireHydrant endpoint: GET /v1/teams/{team_id}/call_routes

List call routes for a team';
    protected const PARAMETERS = array (
  'team_id' =>
  array (
    'type' => 'string',
    'description' => 'team_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/teams/{team_id}/call_routes';
    protected const PATH_PARAMS = array (
  'team_id' => 'team_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
