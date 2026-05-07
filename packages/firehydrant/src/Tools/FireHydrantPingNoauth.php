<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Check API connectivity.
 *
 * Maps to the official FireHydrant endpoint get /v1/noauth/ping.
 */
class FireHydrantPingNoauth extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_ping_noauth';
    protected const DESCRIPTION = 'Check API connectivity

Official FireHydrant endpoint: GET /v1/noauth/ping

Simple endpoint to verify your API connection is working';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/noauth/ping';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
