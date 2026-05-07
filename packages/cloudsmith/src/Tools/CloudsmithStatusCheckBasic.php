<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Endpoint to check basic API connectivity..
 *
 * Maps to the official Cloudsmith endpoint get /status/check/basic/.
 */
class CloudsmithStatusCheckBasic extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_status_check_basic';
    protected const DESCRIPTION = 'Endpoint to check basic API connectivity.

Official Cloudsmith endpoint: GET /status/check/basic/

Endpoint to check basic API connectivity.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/status/check/basic/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
