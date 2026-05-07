<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List On Call Shadows for Shift.
 *
 * Maps to the official Rootly endpoint get /v1/schedules/{schedule_id}/on_call_shadows.
 */
class RootlyListOnCallShadows extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_on_call_shadows';
    protected const DESCRIPTION = 'List On Call Shadows for Shift

Official Rootly endpoint: GET /v1/schedules/{schedule_id}/on_call_shadows

List shadow shifts for schedule';
    protected const PARAMETERS = array (
  'schedule_id' =>
  array (
    'type' => 'string',
    'description' => 'schedule_id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'include parameter.',
  ),
  'page_number' =>
  array (
    'type' => 'integer',
    'description' => 'page[number] parameter.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'page[size] parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/schedules/{schedule_id}/on_call_shadows';
    protected const PATH_PARAMS = array (
  'schedule_id' => 'schedule_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
