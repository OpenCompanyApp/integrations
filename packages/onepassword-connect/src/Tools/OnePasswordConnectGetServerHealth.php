<?php

namespace OpenCompany\Integrations\OnePasswordConnect\Tools;

/**
 * Get state of the server and its dependencies..
 *
 * Maps to the official 1Password Connect endpoint GET /health.
 */
class OnePasswordConnectGetServerHealth extends AbstractOnePasswordConnectTool
{
    protected const NAME = 'onepassword_connect_get_server_health';
    protected const DESCRIPTION = 'Get state of the server and its dependencies.

Official 1Password Connect endpoint: GET /health.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/health';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
