<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a team.
 *
 * Maps to the official FireHydrant endpoint patch /v1/teams/{team_id}.
 */
class FireHydrantUpdateTeam extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_team';
    protected const DESCRIPTION = 'Update a team

Official FireHydrant endpoint: PATCH /v1/teams/{team_id}

Update a single team from its ID';
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
    protected const METHOD = 'patch';
    protected const PATH = '/v1/teams/{team_id}';
    protected const PATH_PARAMS = array (
  'team_id' => 'team_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
