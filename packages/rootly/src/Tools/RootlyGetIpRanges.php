<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves IP ranges.
 *
 * Maps to the official Rootly endpoint get /v1/ip_ranges.
 */
class RootlyGetIpRanges extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_ip_ranges';
    protected const DESCRIPTION = 'Retrieves IP ranges

Official Rootly endpoint: GET /v1/ip_ranges

Retrieves the IP ranges for rootly.com services';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/ip_ranges';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
