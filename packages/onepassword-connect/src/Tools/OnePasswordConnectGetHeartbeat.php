<?php

namespace OpenCompany\Integrations\OnePasswordConnect\Tools;

/**
 * Ping the server for liveness.
 *
 * Maps to the official 1Password Connect endpoint GET /heartbeat.
 */
class OnePasswordConnectGetHeartbeat extends AbstractOnePasswordConnectTool
{
    protected const NAME = 'onepassword_connect_get_heartbeat';
    protected const DESCRIPTION = 'Ping the server for liveness

Official 1Password Connect endpoint: GET /heartbeat.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/heartbeat';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
