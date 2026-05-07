<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Unarchive an incident.
 *
 * Maps to the official FireHydrant endpoint post /v1/incidents/{incident_id}/unarchive.
 */
class FireHydrantUnarchiveIncident extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_unarchive_incident';
    protected const DESCRIPTION = 'Unarchive an incident

Official FireHydrant endpoint: POST /v1/incidents/{incident_id}/unarchive

Unarchive an incident';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incidents/{incident_id}/unarchive';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
