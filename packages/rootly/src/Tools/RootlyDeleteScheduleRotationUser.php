<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a schedule rotation user.
 *
 * Maps to the official Rootly endpoint delete /v1/schedule_rotation_users/{id}.
 */
class RootlyDeleteScheduleRotationUser extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_schedule_rotation_user';
    protected const DESCRIPTION = 'Delete a schedule rotation user

Official Rootly endpoint: DELETE /v1/schedule_rotation_users/{id}

Delete a specific schedule rotation user by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
