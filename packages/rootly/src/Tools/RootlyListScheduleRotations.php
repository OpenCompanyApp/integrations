<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List schedule rotations.
 *
 * Maps to the official Rootly endpoint get /v1/schedules/{schedule_id}/schedule_rotations.
 */
class RootlyListScheduleRotations extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_schedule_rotations';
    protected const DESCRIPTION = 'List schedule rotations

Official Rootly endpoint: GET /v1/schedules/{schedule_id}/schedule_rotations

List schedule rotations';
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
  'sort' =>
  array (
    'type' => 'string',
    'description' => 'sort parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/schedules/{schedule_id}/schedule_rotations';
    protected const PATH_PARAMS = array (
  'schedule_id' => 'schedule_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
