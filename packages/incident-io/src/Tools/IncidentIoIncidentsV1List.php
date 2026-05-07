<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Incidents V1.
 *
 * Maps to the official incident.io endpoint get /v1/incidents.
 */
class IncidentIoIncidentsV1List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incidents_v1_list';
    protected const DESCRIPTION = 'List Incidents V1

Official incident.io endpoint: GET /v1/incidents

List all incidents for an organisation.';
    protected const PARAMETERS = array (
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'Integer number of records to return',
  ),
  'after' =>
  array (
    'type' => 'string',
    'description' => 'An record\'s ID. This endpoint will return a list of records after this ID in relation to the API response order.',
  ),
  'status' =>
  array (
    'type' => 'array',
    'description' => 'Filter for incidents in these statuses',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page_size' => 'page_size',
  'after' => 'after',
  'status' => 'status',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
