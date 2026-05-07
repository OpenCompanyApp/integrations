<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List change events.
 *
 * Maps to the official FireHydrant endpoint get /v1/changes/events.
 */
class FireHydrantListChangeEvents extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_change_events';
    protected const DESCRIPTION = 'List change events

Official FireHydrant endpoint: GET /v1/changes/events

List change events for the organization. Note: Not all information is included on a change event like attachments and related changes. You must fetch a change event separately to retrieve all of the information about it';
    protected const PARAMETERS = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
  'saved_search_id' =>
  array (
    'type' => 'string',
    'description' => 'The id of a previously saved search.',
  ),
  'query' =>
  array (
    'type' => 'string',
    'description' => 'A text query for change events',
  ),
  'labels' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of label key / values in the format of "key=value,key2=value2". To filter change events that have a key (with no specific value), omit the value',
  ),
  'environments' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of environment IDs',
  ),
  'services' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of service IDs',
  ),
  'starts_at' =>
  array (
    'type' => 'string',
    'description' => 'The start time to start returning change events from',
  ),
  'ends_at' =>
  array (
    'type' => 'string',
    'description' => 'The end time to return change events up to',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/changes/events';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'saved_search_id' => 'saved_search_id',
  'query' => 'query',
  'labels' => 'labels',
  'environments' => 'environments',
  'services' => 'services',
  'starts_at' => 'starts_at',
  'ends_at' => 'ends_at',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
