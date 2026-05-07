<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Ping a heartbeat.
 *
 * Maps to the official Rootly endpoint post /v1/heartbeats/{heartbeat_id}/ping.
 */
class RootlyPingHeartbeat extends AbstractRootlyTool
{
    protected const NAME = 'rootly_ping_heartbeat';
    protected const DESCRIPTION = 'Ping a heartbeat

Official Rootly endpoint: POST /v1/heartbeats/{heartbeat_id}/ping

Ping a specific heartbeat by id';
    protected const PARAMETERS = array (
  'heartbeat_id' =>
  array (
    'type' => 'string',
    'description' => 'heartbeat_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/heartbeats/{heartbeat_id}/ping';
    protected const PATH_PARAMS = array (
  'heartbeat_id' => 'heartbeat_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
