<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List impacted infrastructure for an incident.
 *
 * Maps to the official FireHydrant endpoint get /v1/incidents/{incident_id}/impact/{type}.
 */
class FireHydrantListIncidentImpacts extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_incident_impacts';
    protected const DESCRIPTION = 'List impacted infrastructure for an incident

Official FireHydrant endpoint: GET /v1/incidents/{incident_id}/impact/{type}

List impacted infrastructure on an incident by specifying type';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
  'type' =>
  array (
    'type' => 'string',
    'description' => 'type parameter.',
    'required' => true,
    'enum' =>
    array (
      0 => 'environments',
      1 => 'functionalities',
      2 => 'services',
      3 => 'customers',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/impact/{type}';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
  'type' => 'type',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
