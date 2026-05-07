<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * Ping.
 *
 * Maps to the official Semgrep Web API endpoint get /api/v1/ping.
 */
class SemgrepMiscServicePing extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_misc_service_ping';
    protected const DESCRIPTION = 'Ping

Official Semgrep Web API endpoint: GET /api/v1/ping

Use to ping the server and assert liveness.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/ping';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
