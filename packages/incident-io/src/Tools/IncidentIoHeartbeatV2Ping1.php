<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Ping Heartbeat V2.
 *
 * Maps to the official incident.io endpoint get /v2/heartbeat/{alert_source_config_id}/ping.
 */
class IncidentIoHeartbeatV2Ping1 extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_heartbeat_v2_ping_1';
    protected const DESCRIPTION = 'Ping Heartbeat V2

Official incident.io endpoint: GET /v2/heartbeat/{alert_source_config_id}/ping

Send a heartbeat ping for the specified alert source.

Records a ping, indicating that the monitored job or service is healthy. The
heartbeat monitor uses these pings to detect missed heartbeats and fire alerts.
Both GET and POST are accepted';
    protected const PARAMETERS = array (
  'token' =>
  array (
    'type' => 'string',
    'description' => 'Token provided via the token query parameter',
  ),
  'alert_source_config_id' =>
  array (
    'type' => 'string',
    'description' => 'The alert source config this heartbeat ping is for',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/heartbeat/{alert_source_config_id}/ping';
    protected const PATH_PARAMS = array (
  'alert_source_config_id' => 'alert_source_config_id',
);
    protected const QUERY_PARAMS = array (
  'token' => 'token',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
