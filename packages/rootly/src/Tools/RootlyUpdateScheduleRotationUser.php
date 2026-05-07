<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update schedule rotation user.
 *
 * Maps to the official Rootly endpoint put /v1/schedule_rotation_users/{id}.
 */
class RootlyUpdateScheduleRotationUser extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_schedule_rotation_user';
    protected const DESCRIPTION = 'Update schedule rotation user

Official Rootly endpoint: PUT /v1/schedule_rotation_users/{id}

Update a specific schedule rotation user by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/schedule_rotation_users/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
