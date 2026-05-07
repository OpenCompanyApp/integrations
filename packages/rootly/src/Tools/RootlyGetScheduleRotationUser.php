<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a schedule rotation user.
 *
 * Maps to the official Rootly endpoint get /v1/schedule_rotation_users/{id}.
 */
class RootlyGetScheduleRotationUser extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_schedule_rotation_user';
    protected const DESCRIPTION = 'Retrieves a schedule rotation user

Official Rootly endpoint: GET /v1/schedule_rotation_users/{id}

Retrieves a specific schedule rotation user by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/schedule_rotation_users/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
