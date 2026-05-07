<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get an incident.
 *
 * Maps to the official FireHydrant endpoint get /v1/incidents/{incident_id}.
 */
class FireHydrantGetIncident extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_incident';
    protected const DESCRIPTION = 'Get an incident

Official FireHydrant endpoint: GET /v1/incidents/{incident_id}

Retrieve a single incident from its ID';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
