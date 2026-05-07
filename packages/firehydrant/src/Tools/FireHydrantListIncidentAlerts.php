<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List alerts for an incident.
 *
 * Maps to the official FireHydrant endpoint get /v1/incidents/{incident_id}/alerts.
 */
class FireHydrantListIncidentAlerts extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_incident_alerts';
    protected const DESCRIPTION = 'List alerts for an incident

Official FireHydrant endpoint: GET /v1/incidents/{incident_id}/alerts

List alerts that have been attached to an incident';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/alerts';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
