<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update an on-call shift for a team schedule.
 *
 * Maps to the official FireHydrant endpoint patch /v1/teams/{team_id}/on_call_schedules/{schedule_id}/shifts/{id}.
 */
class FireHydrantUpdateOnCallShift extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_on_call_shift';
    protected const DESCRIPTION = 'Update an on-call shift for a team schedule

Official FireHydrant endpoint: PATCH /v1/teams/{team_id}/on_call_schedules/{schedule_id}/shifts/{id}

Update a Signals on-call shift by ID';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
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
    protected const BODY_REQUIRED = true;
}
