<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a schedule rotation.
 *
 * Maps to the official Rootly endpoint post /v1/schedules/{schedule_id}/schedule_rotations.
 */
class RootlyCreateScheduleRotation extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_schedule_rotation';
    protected const DESCRIPTION = 'Creates a schedule rotation

Official Rootly endpoint: POST /v1/schedules/{schedule_id}/schedule_rotations

Creates a new schedule rotation from provided data';
    protected const PARAMETERS = array (
  'schedule_id' =>
  array (
    'type' => 'string',
    'description' => 'schedule_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/schedules/{schedule_id}/schedule_rotations';
    protected const PATH_PARAMS = array (
  'schedule_id' => 'schedule_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
