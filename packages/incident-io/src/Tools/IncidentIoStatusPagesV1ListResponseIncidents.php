<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ListResponseIncidents Status Pages V1.
 *
 * Maps to the official incident.io endpoint get /v1/status-pages/{id}/incidents/{incident_id}/response-incidents.
 */
class IncidentIoStatusPagesV1ListResponseIncidents extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_status_pages_v1_list_response_incidents';
    protected const DESCRIPTION = 'ListResponseIncidents Status Pages V1

Official incident.io endpoint: GET /v1/status-pages/{id}/incidents/{incident_id}/response-incidents

List the linked Response incidents for a status page incident.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the status page',
    'required' => true,
  ),
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the status page incident',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/status-pages/{id}/incidents/{incident_id}/response-incidents';
    protected const PATH_PARAMS = array (
  'id' => 'id',
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
