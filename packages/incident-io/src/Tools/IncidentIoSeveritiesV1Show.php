<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Show Severities V1.
 *
 * Maps to the official incident.io endpoint get /v1/severities/{id}.
 */
class IncidentIoSeveritiesV1Show extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_severities_v1_show';
    protected const DESCRIPTION = 'Show Severities V1

Official incident.io endpoint: GET /v1/severities/{id}

Get a single incident severity.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier of the severity',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/severities/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
