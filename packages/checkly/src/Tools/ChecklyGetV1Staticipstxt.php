<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Lists all IPs for check runs as a TXT file. Each line has one IP..
 *
 * Maps to the official Checkly endpoint GET /v1/static-ips.txt.
 */
class ChecklyGetV1Staticipstxt extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_staticipstxt';
    protected const DESCRIPTION = 'Lists all IPs for check runs as a TXT file. Each line has one IP.

Official Checkly endpoint: GET /v1/static-ips.txt.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/static-ips.txt';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
