<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List events.
 *
 * Maps to the official WorkOS endpoint get /events.
 */
class WorkOSEventsList extends AbstractWorkOSTool
{
    protected const NAME = 'workos_events_list';
    protected const DESCRIPTION = 'List events

Official WorkOS endpoint: GET /events

List events for the current environment.';
    protected const PARAMETERS = array (
  'before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `before` from the official WorkOS API operation.',
  ),
  'after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `after` from the official WorkOS API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official WorkOS API operation.',
  ),
  'order' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `order` from the official WorkOS API operation.',
  ),
  'events' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `events` from the official WorkOS API operation.',
  ),
  'range_start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `range_start` from the official WorkOS API operation.',
  ),
  'range_end' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `range_end` from the official WorkOS API operation.',
  ),
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `organization_id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/events';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'before' => 'before',
  'after' => 'after',
  'limit' => 'limit',
  'order' => 'order',
  'events' => 'events',
  'range_start' => 'range_start',
  'range_end' => 'range_end',
  'organization_id' => 'organization_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
