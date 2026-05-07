<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get a list of all supported distributions..
 *
 * Maps to the official Cloudsmith endpoint get /distros/.
 */
class CloudsmithDistrosList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_distros_list';
    protected const DESCRIPTION = 'Get a list of all supported distributions.

Official Cloudsmith endpoint: GET /distros/

Get a list of all supported distributions.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/distros/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
