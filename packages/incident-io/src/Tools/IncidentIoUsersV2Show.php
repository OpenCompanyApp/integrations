<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Show Users V2.
 *
 * Maps to the official incident.io endpoint get /v2/users/{id}.
 */
class IncidentIoUsersV2Show extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_users_v2_show';
    protected const DESCRIPTION = 'Show Users V2

Official incident.io endpoint: GET /v2/users/{id}

Get a single user.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier of the user',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/users/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
