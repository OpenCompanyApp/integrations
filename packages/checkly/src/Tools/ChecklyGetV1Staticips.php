<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Lists all source IPs for check runs as a single JSON array..
 *
 * Maps to the official Checkly endpoint GET /v1/static-ips.
 */
class ChecklyGetV1Staticips extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_staticips';
    protected const DESCRIPTION = 'Lists all source IPs for check runs as a single JSON array.

Official Checkly endpoint: GET /v1/static-ips.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/static-ips';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
