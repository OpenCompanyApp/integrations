<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Show Alert Sources V2.
 *
 * Maps to the official incident.io endpoint get /v2/alert_sources/{id}.
 */
class IncidentIoAlertSourcesV2Show extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_alert_sources_v2_show';
    protected const DESCRIPTION = 'Show Alert Sources V2

Official incident.io endpoint: GET /v2/alert_sources/{id}

Load details about a specific alert source in your account.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'The ID of this alert source',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/alert_sources/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
