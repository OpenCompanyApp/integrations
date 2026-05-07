<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Lists all source IPs for check runs as an object with regions as keys and an Ipv6 as value..
 *
 * Maps to the official Checkly endpoint GET /v1/static-ipv6s-by-region.
 */
class ChecklyGetV1Staticipv6sbyregion extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_staticipv6sbyregion';
    protected const DESCRIPTION = 'Lists all source IPs for check runs as an object with regions as keys and an Ipv6 as value.

Official Checkly endpoint: GET /v1/static-ipv6s-by-region.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/static-ipv6s-by-region';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
