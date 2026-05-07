<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete an on-call schedule's rotation.
 *
 * Maps to the official FireHydrant endpoint delete /v1/teams/{team_id}/on_call_schedules/{schedule_id}/rotations/{rotation_id}.
 */
class FireHydrantDeleteOnCallScheduleRotation extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_on_call_schedule_rotation';
    protected const DESCRIPTION = 'Delete an on-call schedule\'s rotation

Official FireHydrant endpoint: DELETE /v1/teams/{team_id}/on_call_schedules/{schedule_id}/rotations/{rotation_id}

Delete an on-call schedule\'s rotation by ID';
    protected const PARAMETERS = array (
  'rotation_id' =>
  array (
    'type' => 'string',
    'description' => 'rotation_id parameter.',
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
    protected const METHOD = 'delete';
    protected const PATH = '/v1/teams/{team_id}/on_call_schedules/{schedule_id}/rotations/{rotation_id}';
    protected const PATH_PARAMS = array (
  'rotation_id' => 'rotation_id',
  'team_id' => 'team_id',
  'schedule_id' => 'schedule_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
