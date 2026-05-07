<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update an incident.
 *
 * Maps to the official FireHydrant endpoint patch /v1/incidents/{incident_id}.
 */
class FireHydrantUpdateIncident extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_incident';
    protected const DESCRIPTION = 'Update an incident

Official FireHydrant endpoint: PATCH /v1/incidents/{incident_id}

Updates an incident with provided parameters';
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
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/incidents/{incident_id}';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
