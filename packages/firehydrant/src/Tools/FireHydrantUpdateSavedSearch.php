<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a saved search.
 *
 * Maps to the official FireHydrant endpoint patch /v1/saved_searches/{resource_type}/{saved_search_id}.
 */
class FireHydrantUpdateSavedSearch extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_saved_search';
    protected const DESCRIPTION = 'Update a saved search

Official FireHydrant endpoint: PATCH /v1/saved_searches/{resource_type}/{saved_search_id}

Update a specific saved search';
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
  'saved_search_id' =>
  array (
    'type' => 'string',
    'description' => 'saved_search_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/saved_searches/{resource_type}/{saved_search_id}';
    protected const PATH_PARAMS = array (
  'resource_type' => 'resource_type',
  'saved_search_id' => 'saved_search_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
