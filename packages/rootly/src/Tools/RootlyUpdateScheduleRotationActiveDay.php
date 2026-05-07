<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a schedule rotation active day.
 *
 * Maps to the official Rootly endpoint put /v1/schedule_rotation_active_days/{id}.
 */
class RootlyUpdateScheduleRotationActiveDay extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_schedule_rotation_active_day';
    protected const DESCRIPTION = 'Update a schedule rotation active day

Official Rootly endpoint: PUT /v1/schedule_rotation_active_days/{id}

Update a specific schedule rotation active day by id';
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
    protected const PATH = '/v1/schedule_rotation_active_days/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
