<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a schedule rotation user.
 *
 * Maps to the official Rootly endpoint post /v1/schedule_rotations/{schedule_rotation_id}/schedule_rotation_users.
 */
class RootlyCreateScheduleRotationUser extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_schedule_rotation_user';
    protected const DESCRIPTION = 'Creates a schedule rotation user

Official Rootly endpoint: POST /v1/schedule_rotations/{schedule_rotation_id}/schedule_rotation_users

Creates a new schedule rotation user from provided data';
    protected const PARAMETERS = array (
  'schedule_rotation_id' =>
  array (
    'type' => 'string',
    'description' => 'schedule_rotation_id parameter.',
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
    protected const PATH = '/v1/schedule_rotations/{schedule_rotation_id}/schedule_rotation_users';
    protected const PATH_PARAMS = array (
  'schedule_rotation_id' => 'schedule_rotation_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
