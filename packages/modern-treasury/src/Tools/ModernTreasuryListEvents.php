<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list events.
 *
 * Maps to the official Modern Treasury endpoint get /api/events.
 */
class ModernTreasuryListEvents extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_events';
    protected const DESCRIPTION = 'list events

Official Modern Treasury endpoint: GET /api/events';
    protected const PARAMETERS = array (
  'after_cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `after_cursor` from the official Modern Treasury API operation.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `per_page` from the official Modern Treasury API operation.',
  ),
  'event_time_start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `event_time_start` from the official Modern Treasury API operation.',
  ),
  'event_time_end' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `event_time_end` from the official Modern Treasury API operation.',
  ),
  'resource' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `resource` from the official Modern Treasury API operation.',
  ),
  'entity_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `entity_id` from the official Modern Treasury API operation.',
  ),
  'event_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `event_name` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/events';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'event_time_start' => 'event_time_start',
  'event_time_end' => 'event_time_end',
  'resource' => 'resource',
  'entity_id' => 'entity_id',
  'event_name' => 'event_name',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
