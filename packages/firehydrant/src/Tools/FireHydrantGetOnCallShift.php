<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get an on-call shift for a team schedule.
 *
 * Maps to the official FireHydrant endpoint get /v1/teams/{team_id}/on_call_schedules/{schedule_id}/shifts/{id}.
 */
class FireHydrantGetOnCallShift extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_on_call_shift';
    protected const DESCRIPTION = 'Get an on-call shift for a team schedule

Official FireHydrant endpoint: GET /v1/teams/{team_id}/on_call_schedules/{schedule_id}/shifts/{id}

Get a Signals on-call shift by ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
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
    protected const METHOD = 'get';
    protected const PATH = '/v1/teams/{team_id}/on_call_schedules/{schedule_id}/shifts/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
  'team_id' => 'team_id',
  'schedule_id' => 'schedule_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
