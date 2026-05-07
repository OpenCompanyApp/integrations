<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List related changes on an incident.
 *
 * Maps to the official FireHydrant endpoint get /v1/incidents/{incident_id}/related_change_events.
 */
class FireHydrantListIncidentChangeEvents extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_incident_change_events';
    protected const DESCRIPTION = 'List related changes on an incident

Official FireHydrant endpoint: GET /v1/incidents/{incident_id}/related_change_events

List related changes that have been attached to an incident';
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
  'type' =>
  array (
    'type' => 'string',
    'description' => 'The type of the relation to the incident',
    'enum' =>
    array (
      0 => 'caused',
      1 => 'fixed',
      2 => 'suspect',
      3 => 'dismissed',
    ),
  ),
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/related_change_events';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'type' => 'type',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
