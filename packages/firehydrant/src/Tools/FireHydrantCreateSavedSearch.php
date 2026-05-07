<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a saved search.
 *
 * Maps to the official FireHydrant endpoint post /v1/saved_searches/{resource_type}.
 */
class FireHydrantCreateSavedSearch extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_saved_search';
    protected const DESCRIPTION = 'Create a saved search

Official FireHydrant endpoint: POST /v1/saved_searches/{resource_type}

Create a new saved search for a particular resource type';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/saved_searches/{resource_type}';
    protected const PATH_PARAMS = array (
  'resource_type' => 'resource_type',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
