<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List saved searches.
 *
 * Maps to the official FireHydrant endpoint get /v1/saved_searches/{resource_type}.
 */
class FireHydrantListSavedSearches extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_saved_searches';
    protected const DESCRIPTION = 'List saved searches

Official FireHydrant endpoint: GET /v1/saved_searches/{resource_type}

Lists saved searches';
    protected const PARAMETERS = array (
  'resource_type' =>
  array (
    'type' => 'string',
    'description' => 'resource_type parameter.',
    'required' => true,
    'enum' =>
    array (
      0 => 'change_events',
      1 => 'incidents',
      2 => 'services',
      3 => 'scheduled_maintenances',
      4 => 'ticket_tasks',
      5 => 'ticket_follow_ups',
      6 => 'analytics',
      7 => 'impact_analytics',
      8 => 'alerts',
      9 => 'alert_analytics',
      10 => 'incident_events',
    ),
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'The user ID used to filter saved searches.',
  ),
  'query' =>
  array (
    'type' => 'string',
    'description' => 'Filter saved searches with a query on their name',
  ),
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
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/saved_searches/{resource_type}';
    protected const PATH_PARAMS = array (
  'resource_type' => 'resource_type',
);
    protected const QUERY_PARAMS = array (
  'user_id' => 'user_id',
  'query' => 'query',
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
