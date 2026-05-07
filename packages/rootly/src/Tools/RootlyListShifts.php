<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List shifts.
 *
 * Maps to the official Rootly endpoint get /v1/shifts.
 */
class RootlyListShifts extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_shifts';
    protected const DESCRIPTION = 'List shifts

Official Rootly endpoint: GET /v1/shifts

List shifts';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: shift_override,user. Note: `user` is deprecated, use `assignee` instead.',
    'enum' =>
    array (
      0 => 'shift_override',
      1 => 'user',
      2 => 'assignee',
      3 => 'shift_shadow',
    ),
  ),
  'from' =>
  array (
    'type' => 'string',
    'description' => 'Start range for shifts in ISO-8601 format (e.g., 2025-01-01T00:00:00Z or 2025-01-01T00:00:00+00:00)',
  ),
  'to' =>
  array (
    'type' => 'string',
    'description' => 'End range for shifts in ISO-8601 format (e.g., 2025-01-01T00:00:00Z or 2025-01-01T00:00:00+00:00)',
  ),
  'user_ids' =>
  array (
    'type' => 'array',
    'description' => 'user_ids[] parameter.',
  ),
  'schedule_ids' =>
  array (
    'type' => 'array',
    'description' => 'schedule_ids[] parameter.',
  ),
  'page_number' =>
  array (
    'type' => 'integer',
    'description' => 'Page number (defaults to 1)',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'Number of shifts per page (defaults to 50, max 1000)',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/shifts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'from' => 'from',
  'to' => 'to',
  'user_ids[]' => 'user_ids',
  'schedule_ids[]' => 'schedule_ids',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
