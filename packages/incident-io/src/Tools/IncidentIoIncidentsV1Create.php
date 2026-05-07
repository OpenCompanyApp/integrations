<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Create Incidents V1.
 *
 * Maps to the official incident.io endpoint post /v1/incidents.
 */
class IncidentIoIncidentsV1Create extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incidents_v1_create';
    protected const DESCRIPTION = 'Create Incidents V1

Official incident.io endpoint: POST /v1/incidents

Create a new incident.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incidents';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
