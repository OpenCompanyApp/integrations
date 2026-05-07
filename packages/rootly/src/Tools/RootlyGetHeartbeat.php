<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a heartbeat.
 *
 * Maps to the official Rootly endpoint get /v1/heartbeats/{id}.
 */
class RootlyGetHeartbeat extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_heartbeat';
    protected const DESCRIPTION = 'Retrieves a heartbeat

Official Rootly endpoint: GET /v1/heartbeats/{id}

Retrieves a specific heartbeat by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/heartbeats/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
