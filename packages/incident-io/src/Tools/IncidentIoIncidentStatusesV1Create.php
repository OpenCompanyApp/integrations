<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Create Incident Statuses V1.
 *
 * Maps to the official incident.io endpoint post /v1/incident_statuses.
 */
class IncidentIoIncidentStatusesV1Create extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incident_statuses_v1_create';
    protected const DESCRIPTION = 'Create Incident Statuses V1

Official incident.io endpoint: POST /v1/incident_statuses

Create a new incident status';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incident_statuses';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
