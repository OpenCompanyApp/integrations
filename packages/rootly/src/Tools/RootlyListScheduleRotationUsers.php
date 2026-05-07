<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List schedule rotation users.
 *
 * Maps to the official Rootly endpoint get /v1/schedule_rotations/{schedule_rotation_id}/schedule_rotation_users.
 */
class RootlyListScheduleRotationUsers extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_schedule_rotation_users';
    protected const DESCRIPTION = 'List schedule rotation users

Official Rootly endpoint: GET /v1/schedule_rotations/{schedule_rotation_id}/schedule_rotation_users';
    protected const PARAMETERS = array (
  'schedule_rotation_id' =>
  array (
    'type' => 'string',
    'description' => 'schedule_rotation_id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'include parameter.',
  ),
  'page_number' =>
  array (
    'type' => 'integer',
    'description' => 'page[number] parameter.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'page[size] parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/schedule_rotations/{schedule_rotation_id}/schedule_rotation_users';
    protected const PATH_PARAMS = array (
  'schedule_rotation_id' => 'schedule_rotation_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
