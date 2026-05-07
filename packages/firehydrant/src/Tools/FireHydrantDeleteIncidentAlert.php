<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Remove an alert from an incident.
 *
 * Maps to the official FireHydrant endpoint delete /v1/incidents/{incident_id}/alerts/{incident_alert_id}.
 */
class FireHydrantDeleteIncidentAlert extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_incident_alert';
    protected const DESCRIPTION = 'Remove an alert from an incident

Official FireHydrant endpoint: DELETE /v1/incidents/{incident_id}/alerts/{incident_alert_id}

Remove an alert from an incident';
    protected const PARAMETERS = array (
  'incident_alert_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_alert_id parameter.',
    'required' => true,
  ),
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/incidents/{incident_id}/alerts/{incident_alert_id}';
    protected const PATH_PARAMS = array (
  'incident_alert_id' => 'incident_alert_id',
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
