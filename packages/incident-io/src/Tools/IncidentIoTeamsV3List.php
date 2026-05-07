<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Teams V3.
 *
 * Maps to the official incident.io endpoint get /v3/teams.
 */
class IncidentIoTeamsV3List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_teams_v3_list';
    protected const DESCRIPTION = 'List Teams V3

Official incident.io endpoint: GET /v3/teams

List all teams in the organisation.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/v3/teams';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page_size' => 'page_size',
  'after' => 'after',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
