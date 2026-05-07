<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a schedule shifts.
 *
 * Maps to the official Rootly endpoint get /v1/schedules/{id}/shifts.
 */
class RootlyGetScheduleShifts extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_schedule_shifts';
    protected const DESCRIPTION = 'Retrieves a schedule shifts

Official Rootly endpoint: GET /v1/schedules/{id}/shifts

Retrieves schedule shifts';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'to' =>
  array (
    'type' => 'string',
    'description' => 'to parameter.',
  ),
  'from' =>
  array (
    'type' => 'string',
    'description' => 'from parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/schedules/{id}/shifts';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'to' => 'to',
  'from' => 'from',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
