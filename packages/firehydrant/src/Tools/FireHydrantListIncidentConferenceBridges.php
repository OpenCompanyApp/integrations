<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Retrieve all conference bridges for an incident.
 *
 * Maps to the official FireHydrant endpoint get /v1/incidents/{incident_id}/conference_bridges.
 */
class FireHydrantListIncidentConferenceBridges extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_incident_conference_bridges';
    protected const DESCRIPTION = 'Retrieve all conference bridges for an incident

Official FireHydrant endpoint: GET /v1/incidents/{incident_id}/conference_bridges

Retrieve all conference bridges for an incident';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/conference_bridges';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
