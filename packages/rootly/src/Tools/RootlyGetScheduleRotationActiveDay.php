<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a schedule rotation active day.
 *
 * Maps to the official Rootly endpoint get /v1/schedule_rotation_active_days/{id}.
 */
class RootlyGetScheduleRotationActiveDay extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_schedule_rotation_active_day';
    protected const DESCRIPTION = 'Retrieves a schedule rotation active day

Official Rootly endpoint: GET /v1/schedule_rotation_active_days/{id}

Retrieves a specific schedule rotation active day by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/schedule_rotation_active_days/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
