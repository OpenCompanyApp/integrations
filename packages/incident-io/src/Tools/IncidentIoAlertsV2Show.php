<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Show Alerts V2.
 *
 * Maps to the official incident.io endpoint get /v2/alerts/{id}.
 */
class IncidentIoAlertsV2Show extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_alerts_v2_show';
    protected const DESCRIPTION = 'Show Alerts V2

Official incident.io endpoint: GET /v2/alerts/{id}

Show a single alert for your account';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for the alert',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/alerts/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
