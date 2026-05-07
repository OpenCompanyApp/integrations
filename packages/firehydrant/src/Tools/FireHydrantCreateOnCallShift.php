<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a shift for an on-call schedule.
 *
 * Maps to the official FireHydrant endpoint post /v1/teams/{team_id}/on_call_schedules/{schedule_id}/shifts.
 */
class FireHydrantCreateOnCallShift extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_on_call_shift';
    protected const DESCRIPTION = 'Create a shift for an on-call schedule

Official FireHydrant endpoint: POST /v1/teams/{team_id}/on_call_schedules/{schedule_id}/shifts

Create a Signals on-call shift in a schedule.';
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
    protected const METHOD = 'post';
    protected const PATH = '/v1/teams/{team_id}/on_call_schedules/{schedule_id}/shifts';
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
