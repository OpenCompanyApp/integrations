<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Archive an incident.
 *
 * Maps to the official FireHydrant endpoint delete /v1/incidents/{incident_id}.
 */
class FireHydrantDeleteIncident extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_incident';
    protected const DESCRIPTION = 'Archive an incident

Official FireHydrant endpoint: DELETE /v1/incidents/{incident_id}

Archives an incident which will hide it from lists and metrics';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
