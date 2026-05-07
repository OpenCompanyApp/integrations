<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a call route for a team.
 *
 * Maps to the official FireHydrant endpoint post /v1/teams/{team_id}/call_routes.
 */
class FireHydrantCreateTeamCallRoute extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_team_call_route';
    protected const DESCRIPTION = 'Create a call route for a team

Official FireHydrant endpoint: POST /v1/teams/{team_id}/call_routes

Create a call route for a team';
    protected const PARAMETERS = array (
  'team_id' =>
  array (
    'type' => 'string',
    'description' => 'team_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/teams/{team_id}/call_routes';
    protected const PATH_PARAMS = array (
  'team_id' => 'team_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
