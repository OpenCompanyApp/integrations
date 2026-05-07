<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete an on-call schedule for a team.
 *
 * Maps to the official FireHydrant endpoint delete /v1/teams/{team_id}/on_call_schedules/{schedule_id}.
 */
class FireHydrantDeleteTeamOnCallSchedule extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_team_on_call_schedule';
    protected const DESCRIPTION = 'Delete an on-call schedule for a team

Official FireHydrant endpoint: DELETE /v1/teams/{team_id}/on_call_schedules/{schedule_id}

Delete a Signals on-call schedule by ID';
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
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/teams/{team_id}/on_call_schedules/{schedule_id}';
    protected const PATH_PARAMS = array (
  'team_id' => 'team_id',
  'schedule_id' => 'schedule_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
