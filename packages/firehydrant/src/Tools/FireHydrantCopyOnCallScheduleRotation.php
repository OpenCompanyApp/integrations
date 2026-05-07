<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Copy an on-call schedule's rotation.
 *
 * Maps to the official FireHydrant endpoint post /v1/teams/{team_id}/on_call_schedules/{schedule_id}/rotations/{rotation_id}/copy.
 */
class FireHydrantCopyOnCallScheduleRotation extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_copy_on_call_schedule_rotation';
    protected const DESCRIPTION = 'Copy an on-call schedule\'s rotation

Official FireHydrant endpoint: POST /v1/teams/{team_id}/on_call_schedules/{schedule_id}/rotations/{rotation_id}/copy

Copy an on-call rotation into a different schedule, allowing you to merge them together safely.';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/teams/{team_id}/on_call_schedules/{schedule_id}/rotations/{rotation_id}/copy';
    protected const PATH_PARAMS = array (
  'rotation_id' => 'rotation_id',
  'team_id' => 'team_id',
  'schedule_id' => 'schedule_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
