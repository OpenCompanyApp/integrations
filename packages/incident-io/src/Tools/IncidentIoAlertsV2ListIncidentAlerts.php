<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ListIncidentAlerts Alerts V2.
 *
 * Maps to the official incident.io endpoint get /v2/incident_alerts.
 */
class IncidentIoAlertsV2ListIncidentAlerts extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_alerts_v2_list_incident_alerts';
    protected const DESCRIPTION = 'ListIncidentAlerts Alerts V2

Official incident.io endpoint: GET /v2/incident_alerts

List the connections between incidents and alerts';
    protected const PARAMETERS = array (
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'Number of incident alerts to return per page',
    'required' => true,
  ),
  'after' =>
  array (
    'type' => 'string',
    'description' => 'If provided, pass this as the \'after\' param to load the next page',
  ),
  'alert_id' =>
  array (
    'type' => 'string',
    'description' => 'Alert that this incident alert refers to',
  ),
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'Incident that this incident alert is attached to',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/incident_alerts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page_size' => 'page_size',
  'after' => 'after',
  'alert_id' => 'alert_id',
  'incident_id' => 'incident_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
