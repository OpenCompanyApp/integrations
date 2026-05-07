<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a schedule rotation.
 *
 * Maps to the official Rootly endpoint delete /v1/schedule_rotations/{id}.
 */
class RootlyDeleteScheduleRotation extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_schedule_rotation';
    protected const DESCRIPTION = 'Delete a schedule rotation

Official Rootly endpoint: DELETE /v1/schedule_rotations/{id}

Delete a specific schedule rotation by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/schedule_rotations/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
