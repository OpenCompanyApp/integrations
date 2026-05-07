<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get a list of all supported package formats..
 *
 * Maps to the official Cloudsmith endpoint get /formats/.
 */
class CloudsmithFormatsList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_formats_list';
    protected const DESCRIPTION = 'Get a list of all supported package formats.

Official Cloudsmith endpoint: GET /formats/

Get a list of all supported package formats.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/formats/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
