<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Create Severities V1.
 *
 * Maps to the official incident.io endpoint post /v1/severities.
 */
class IncidentIoSeveritiesV1Create extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_severities_v1_create';
    protected const DESCRIPTION = 'Create Severities V1

Official incident.io endpoint: POST /v1/severities

Create a new severity';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/severities';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
