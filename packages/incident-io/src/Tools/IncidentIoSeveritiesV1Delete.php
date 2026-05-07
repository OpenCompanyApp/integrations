<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Delete Severities V1.
 *
 * Maps to the official incident.io endpoint delete /v1/severities/{id}.
 */
class IncidentIoSeveritiesV1Delete extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_severities_v1_delete';
    protected const DESCRIPTION = 'Delete Severities V1

Official incident.io endpoint: DELETE /v1/severities/{id}

Delete a severity';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier of the severity',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
