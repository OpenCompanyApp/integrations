<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a schedule rotation.
 *
 * Maps to the official Rootly endpoint get /v1/schedule_rotations/{id}.
 */
class RootlyGetScheduleRotation extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_schedule_rotation';
    protected const DESCRIPTION = 'Retrieves a schedule rotation

Official Rootly endpoint: GET /v1/schedule_rotations/{id}

Retrieves a specific schedule rotation by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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
