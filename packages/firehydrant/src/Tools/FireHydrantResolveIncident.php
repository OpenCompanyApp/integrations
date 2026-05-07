<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Resolve an incident.
 *
 * Maps to the official FireHydrant endpoint put /v1/incidents/{incident_id}/resolve.
 */
class FireHydrantResolveIncident extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_resolve_incident';
    protected const DESCRIPTION = 'Resolve an incident

Official FireHydrant endpoint: PUT /v1/incidents/{incident_id}/resolve

Resolves a currently active incident';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/incidents/{incident_id}/resolve';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
