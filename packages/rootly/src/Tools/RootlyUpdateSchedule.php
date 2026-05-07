<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a schedule.
 *
 * Maps to the official Rootly endpoint put /v1/schedules/{id}.
 */
class RootlyUpdateSchedule extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_schedule';
    protected const DESCRIPTION = 'Update a schedule

Official Rootly endpoint: PUT /v1/schedules/{id}

Updates a specific schedule by id';
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
    protected const PATH = '/v1/schedules/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
