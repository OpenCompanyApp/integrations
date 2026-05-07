<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update an on-call schedule for a team.
 *
 * Maps to the official FireHydrant endpoint patch /v1/teams/{team_id}/on_call_schedules/{schedule_id}.
 */
class FireHydrantUpdateTeamOnCallSchedule extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_team_on_call_schedule';
    protected const DESCRIPTION = 'Update an on-call schedule for a team

Official FireHydrant endpoint: PATCH /v1/teams/{team_id}/on_call_schedules/{schedule_id}

Update a Signals on-call schedule by ID. For backwards compatibility, all parameters except for
`name` and `description` will be ignored if the schedule has more than one rotation. If the schedule
has only one rotation, you can continue to update that rotation using the rotation-specific parameters.';
    protected const PARAMETERS = array (
  'team_id' =>
  array (
    'type' => 'string',
    'description' => 'team_id parameter.',
    'required' => true,
  ),
  'schedule_id' =>
  array (
    'type' => 'string',
    'description' => 'schedule_id parameter.',
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
    protected const PATH = '/v1/teams/{team_id}/on_call_schedules/{schedule_id}';
    protected const PATH_PARAMS = array (
  'team_id' => 'team_id',
  'schedule_id' => 'schedule_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
