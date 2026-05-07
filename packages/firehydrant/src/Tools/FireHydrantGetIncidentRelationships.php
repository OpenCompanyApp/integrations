<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List incident relationships.
 *
 * Maps to the official FireHydrant endpoint get /v1/incidents/{incident_id}/relationships.
 */
class FireHydrantGetIncidentRelationships extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_incident_relationships';
    protected const DESCRIPTION = 'List incident relationships

Official FireHydrant endpoint: GET /v1/incidents/{incident_id}/relationships

List any parent/child relationships for an incident';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/relationships';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
