<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List on-call schedules for a team.
 *
 * Maps to the official FireHydrant endpoint get /v1/teams/{team_id}/on_call_schedules.
 */
class FireHydrantListTeamOnCallSchedules extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_team_on_call_schedules';
    protected const DESCRIPTION = 'List on-call schedules for a team

Official FireHydrant endpoint: GET /v1/teams/{team_id}/on_call_schedules

List all Signals on-call schedules for a team.';
    protected const PARAMETERS = array (
  'team_id' =>
  array (
    'type' => 'string',
    'description' => 'team_id parameter.',
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
  'query' =>
  array (
    'type' => 'string',
    'description' => 'A query string for searching through the list of on-call schedules.',
  ),
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/teams/{team_id}/on_call_schedules';
    protected const PATH_PARAMS = array (
  'team_id' => 'team_id',
);
    protected const QUERY_PARAMS = array (
  'shift_time_window_start' => 'shift_time_window_start',
  'shift_time_window_end' => 'shift_time_window_end',
  'query' => 'query',
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
