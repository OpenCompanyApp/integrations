<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * All attached retrospectives for an incident.
 *
 * Maps to the official FireHydrant endpoint get /v1/incidents/{incident_id}/retrospectives.
 */
class FireHydrantListIncidentRetrospectives extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_incident_retrospectives';
    protected const DESCRIPTION = 'All attached retrospectives for an incident

Official FireHydrant endpoint: GET /v1/incidents/{incident_id}/retrospectives

Retrieve retrospectives attached to an incident';
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
  'is_hidden' =>
  array (
    'type' => 'boolean',
    'description' => 'Filter by hidden status.',
  ),
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/retrospectives';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'is_hidden' => 'is_hidden',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
