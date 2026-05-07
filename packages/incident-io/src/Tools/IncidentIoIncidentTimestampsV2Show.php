<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Show Incident Timestamps V2.
 *
 * Maps to the official incident.io endpoint get /v2/incident_timestamps/{id}.
 */
class IncidentIoIncidentTimestampsV2Show extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incident_timestamps_v2_show';
    protected const DESCRIPTION = 'Show Incident Timestamps V2

Official incident.io endpoint: GET /v2/incident_timestamps/{id}

Get a single incident timestamp.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique ID of this incident timestamp',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/incident_timestamps/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
