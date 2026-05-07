<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Remove impacted infrastructure from an incident.
 *
 * Maps to the official FireHydrant endpoint delete /v1/incidents/{incident_id}/impact/{type}/{id}.
 */
class FireHydrantDeleteIncidentImpact extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_incident_impact';
    protected const DESCRIPTION = 'Remove impacted infrastructure from an incident

Official FireHydrant endpoint: DELETE /v1/incidents/{incident_id}/impact/{type}/{id}

Remove impacted infrastructure from an incident';
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
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/incidents/{incident_id}/impact/{type}/{id}';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
  'type' => 'type',
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
