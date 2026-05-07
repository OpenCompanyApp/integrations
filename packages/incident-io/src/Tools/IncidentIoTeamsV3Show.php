<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Show Teams V3.
 *
 * Maps to the official incident.io endpoint get /v3/teams/{id}.
 */
class IncidentIoTeamsV3Show extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_teams_v3_show';
    protected const DESCRIPTION = 'Show Teams V3

Official incident.io endpoint: GET /v3/teams/{id}

Get a single team.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique ID of the team',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v3/teams/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
