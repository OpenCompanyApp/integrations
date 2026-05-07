<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * creates an override shift.
 *
 * Maps to the official Rootly endpoint post /v1/schedules/{schedule_id}/override_shifts.
 */
class RootlyCreateOverrideShift extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_override_shift';
    protected const DESCRIPTION = 'creates an override shift

Official Rootly endpoint: POST /v1/schedules/{schedule_id}/override_shifts

Creates a new override shift from provided data. If any existing override shifts overlap with the specified time range, they will be automatically deleted and replaced by the new override.';
    protected const PARAMETERS = array (
  'schedule_id' =>
  array (
    'type' => 'string',
    'description' => 'schedule_id parameter.',
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
    protected const PATH = '/v1/schedules/{schedule_id}/override_shifts';
    protected const PATH_PARAMS = array (
  'schedule_id' => 'schedule_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
