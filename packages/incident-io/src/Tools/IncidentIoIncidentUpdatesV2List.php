<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Incident Updates V2.
 *
 * Maps to the official incident.io endpoint get /v2/incident_updates.
 */
class IncidentIoIncidentUpdatesV2List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incident_updates_v2_list';
    protected const DESCRIPTION = 'List Incident Updates V2

Official incident.io endpoint: GET /v2/incident_updates

List all incident updates for an organisation, or for a specific incident.';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'Incident whose updates you want to list',
  ),
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
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/incident_updates';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'incident_id' => 'incident_id',
  'page_size' => 'page_size',
  'after' => 'after',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
