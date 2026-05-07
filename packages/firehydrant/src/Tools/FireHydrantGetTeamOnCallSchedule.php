<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get an on-call schedule for a team.
 *
 * Maps to the official FireHydrant endpoint get /v1/teams/{team_id}/on_call_schedules/{schedule_id}.
 */
class FireHydrantGetTeamOnCallSchedule extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_team_on_call_schedule';
    protected const DESCRIPTION = 'Get an on-call schedule for a team

Official FireHydrant endpoint: GET /v1/teams/{team_id}/on_call_schedules/{schedule_id}

Get a Signals on-call schedule by ID';
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
  'shift_time_window_start' =>
  array (
    'type' => 'string',
    'description' => 'An optional ISO8601 timestamp for filtering the shifts listed in each on-call schedule to only include shifts that overlap with the provided time window. If provided, only shifts that end at or after this time will be included.',
  ),
  'shift_time_window_end' =>
  array (
    'type' => 'string',
    'description' => 'An optional ISO8601 timestamp for filtering the shifts listed in each on-call schedule to only include shifts that overlap with the provided time window.. If provided, only shifts that start at or before this time will be included.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/teams/{team_id}/on_call_schedules/{schedule_id}';
    protected const PATH_PARAMS = array (
  'team_id' => 'team_id',
  'schedule_id' => 'schedule_id',
);
    protected const QUERY_PARAMS = array (
  'shift_time_window_start' => 'shift_time_window_start',
  'shift_time_window_end' => 'shift_time_window_end',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
