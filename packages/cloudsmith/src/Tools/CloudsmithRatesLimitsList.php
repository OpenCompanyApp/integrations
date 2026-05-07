<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Endpoint to check rate limits for current user..
 *
 * Maps to the official Cloudsmith endpoint get /rates/limits/.
 */
class CloudsmithRatesLimitsList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_rates_limits_list';
    protected const DESCRIPTION = 'Endpoint to check rate limits for current user.

Official Cloudsmith endpoint: GET /rates/limits/

Endpoint to check rate limits for current user.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/rates/limits/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
