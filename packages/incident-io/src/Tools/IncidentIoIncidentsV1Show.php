<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Show Incidents V1.
 *
 * Maps to the official incident.io endpoint get /v1/incidents/{id}.
 */
class IncidentIoIncidentsV1Show extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incidents_v1_show';
    protected const DESCRIPTION = 'Show Incidents V1

Official incident.io endpoint: GET /v1/incidents/{id}

Get a single incident.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for the incident',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
