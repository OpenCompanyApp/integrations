<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a heartbeat.
 *
 * Maps to the official Rootly endpoint delete /v1/heartbeats/{id}.
 */
class RootlyDeleteHeartbeat extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_heartbeat';
    protected const DESCRIPTION = 'Delete a heartbeat

Official Rootly endpoint: DELETE /v1/heartbeats/{id}

Delete a specific heartbeat by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
