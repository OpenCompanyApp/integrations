<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a schedule rotation.
 *
 * Maps to the official Rootly endpoint put /v1/schedule_rotations/{id}.
 */
class RootlyUpdateScheduleRotation extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_schedule_rotation';
    protected const DESCRIPTION = 'Update a schedule rotation

Official Rootly endpoint: PUT /v1/schedule_rotations/{id}

Update a specific schedule rotation by id';
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
    protected const PATH = '/v1/schedule_rotations/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
