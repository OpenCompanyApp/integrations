<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Archive a team.
 *
 * Maps to the official FireHydrant endpoint delete /v1/teams/{team_id}.
 */
class FireHydrantDeleteTeam extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_team';
    protected const DESCRIPTION = 'Archive a team

Official FireHydrant endpoint: DELETE /v1/teams/{team_id}

Archives an team which will hide it from lists and metrics';
    protected const PARAMETERS = array (
  'team_id' =>
  array (
    'type' => 'string',
    'description' => 'team_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/teams/{team_id}';
    protected const PATH_PARAMS = array (
  'team_id' => 'team_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
