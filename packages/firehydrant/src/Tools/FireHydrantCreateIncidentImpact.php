<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Add impacted infrastructure to an incident.
 *
 * Maps to the official FireHydrant endpoint post /v1/incidents/{incident_id}/impact/{type}.
 */
class FireHydrantCreateIncidentImpact extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_incident_impact';
    protected const DESCRIPTION = 'Add impacted infrastructure to an incident

Official FireHydrant endpoint: POST /v1/incidents/{incident_id}/impact/{type}

Add impacted infrastructure to an incident';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incidents/{incident_id}/impact/{type}';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
  'type' => 'type',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
