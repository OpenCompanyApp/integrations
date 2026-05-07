<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Show Incident Statuses V1.
 *
 * Maps to the official incident.io endpoint get /v1/incident_statuses/{id}.
 */
class IncidentIoIncidentStatusesV1Show extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incident_statuses_v1_show';
    protected const DESCRIPTION = 'Show Incident Statuses V1

Official incident.io endpoint: GET /v1/incident_statuses/{id}

Get a single incident status.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique ID of this incident status',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incident_statuses/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
