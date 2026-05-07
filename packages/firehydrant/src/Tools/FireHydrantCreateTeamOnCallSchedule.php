<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create an on-call schedule for a team.
 *
 * Maps to the official FireHydrant endpoint post /v1/teams/{team_id}/on_call_schedules.
 */
class FireHydrantCreateTeamOnCallSchedule extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_team_on_call_schedule';
    protected const DESCRIPTION = 'Create an on-call schedule for a team

Official FireHydrant endpoint: POST /v1/teams/{team_id}/on_call_schedules

Create a Signals on-call schedule for a team with a single rotation. More rotations can be created later.';
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
    protected const PATH = '/v1/teams/{team_id}/on_call_schedules';
    protected const PATH_PARAMS = array (
  'team_id' => 'team_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
