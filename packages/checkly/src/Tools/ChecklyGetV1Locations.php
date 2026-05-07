<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Lists all supported locationss..
 *
 * Maps to the official Checkly endpoint GET /v1/locations.
 */
class ChecklyGetV1Locations extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_locations';
    protected const DESCRIPTION = 'Lists all supported locationss.

Official Checkly endpoint: GET /v1/locations.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/locations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
