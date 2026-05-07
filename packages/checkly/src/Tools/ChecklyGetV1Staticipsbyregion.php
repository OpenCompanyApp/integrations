<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Lists all source IPs for check runs as object with regions as keys and an array of IPs as value..
 *
 * Maps to the official Checkly endpoint GET /v1/static-ips-by-region.
 */
class ChecklyGetV1Staticipsbyregion extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_staticipsbyregion';
    protected const DESCRIPTION = 'Lists all source IPs for check runs as object with regions as keys and an array of IPs as value.

Official Checkly endpoint: GET /v1/static-ips-by-region.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/static-ips-by-region';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
