<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Lists all source IPv6s for check runs as a single JSON array..
 *
 * Maps to the official Checkly endpoint GET /v1/static-ipv6s.
 */
class ChecklyGetV1Staticipv6s extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_staticipv6s';
    protected const DESCRIPTION = 'Lists all source IPv6s for check runs as a single JSON array.

Official Checkly endpoint: GET /v1/static-ipv6s.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/static-ipv6s';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
