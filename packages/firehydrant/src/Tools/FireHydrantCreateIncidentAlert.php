<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Attach an alert to an incident.
 *
 * Maps to the official FireHydrant endpoint post /v1/incidents/{incident_id}/alerts.
 */
class FireHydrantCreateIncidentAlert extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_incident_alert';
    protected const DESCRIPTION = 'Attach an alert to an incident

Official FireHydrant endpoint: POST /v1/incidents/{incident_id}/alerts

Add an alert to an incident. FireHydrant needs to have ingested the alert from a third party system in order to attach it to the incident.';
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
    'description' => 'Array of alert IDs to be assigned to the incident',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incidents/{incident_id}/alerts';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
