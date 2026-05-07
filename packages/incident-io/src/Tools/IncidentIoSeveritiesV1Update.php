<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Update Severities V1.
 *
 * Maps to the official incident.io endpoint put /v1/severities/{id}.
 */
class IncidentIoSeveritiesV1Update extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_severities_v1_update';
    protected const DESCRIPTION = 'Update Severities V1

Official incident.io endpoint: PUT /v1/severities/{id}

Update an existing severity';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier of the severity',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/severities/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
