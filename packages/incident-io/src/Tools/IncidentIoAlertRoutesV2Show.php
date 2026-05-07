<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Show Alert Routes V2.
 *
 * Maps to the official incident.io endpoint get /v2/alert_routes/{id}.
 */
class IncidentIoAlertRoutesV2Show extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_alert_routes_v2_show';
    protected const DESCRIPTION = 'Show Alert Routes V2

Official incident.io endpoint: GET /v2/alert_routes/{id}

Load details about a specific alert route in your account.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier of the alert route',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/alert_routes/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
