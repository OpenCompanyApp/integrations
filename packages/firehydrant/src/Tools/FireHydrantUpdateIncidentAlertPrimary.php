<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Set an alert as primary for an incident.
 *
 * Maps to the official FireHydrant endpoint patch /v1/incidents/{incident_id}/alerts/{incident_alert_id}/primary.
 */
class FireHydrantUpdateIncidentAlertPrimary extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_incident_alert_primary';
    protected const DESCRIPTION = 'Set an alert as primary for an incident

Official FireHydrant endpoint: PATCH /v1/incidents/{incident_id}/alerts/{incident_alert_id}/primary

Setting an alert as primary will overwrite milestone times in the FireHydrant incident with times included in the primary alert. Services attached to the primary alert will also be automatically added to the incident.';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/incidents/{incident_id}/alerts/{incident_alert_id}/primary';
    protected const PATH_PARAMS = array (
  'incident_alert_id' => 'incident_alert_id',
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
