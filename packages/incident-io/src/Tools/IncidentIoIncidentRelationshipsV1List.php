<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Incident Relationships V1.
 *
 * Maps to the official incident.io endpoint get /v1/incident_relationships.
 */
class IncidentIoIncidentRelationshipsV1List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incident_relationships_v1_list';
    protected const DESCRIPTION = 'List Incident Relationships V1

Official incident.io endpoint: GET /v1/incident_relationships

List related incidents for a specific incident.';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the incident to find relationships for',
    'required' => true,
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
    protected const PATH = '/v1/incident_relationships';
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
