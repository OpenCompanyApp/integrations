<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Show Incidents V2.
 *
 * Maps to the official incident.io endpoint get /v2/incidents/{id}.
 */
class IncidentIoIncidentsV2Show extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incidents_v2_show';
    protected const DESCRIPTION = 'Show Incidents V2

Official incident.io endpoint: GET /v2/incidents/{id}

Get a single incident.

The ID supplied can be either the incident\'s full ID, or the numeric part of its
reference. For example, to get INC-123, you could use either its full ID or:

		curl \\
			--get \'https://api.incident.io/v2/incidents/123';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for the incident',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/incidents/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
