<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Show Incident Types V1.
 *
 * Maps to the official incident.io endpoint get /v1/incident_types/{id}.
 */
class IncidentIoIncidentTypesV1Show extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incident_types_v1_show';
    protected const DESCRIPTION = 'Show Incident Types V1

Official incident.io endpoint: GET /v1/incident_types/{id}

Get a single incident type.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for this Incident Type',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incident_types/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
