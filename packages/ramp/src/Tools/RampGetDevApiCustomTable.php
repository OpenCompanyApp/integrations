<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List Custom Tables.
 *
 * Maps to the official Ramp endpoint get /developer/v1/custom-records/custom-tables.
 */
class RampGetDevApiCustomTable extends AbstractRampTool
{
    protected const NAME = 'ramp_get_dev_api_custom_table';
    protected const DESCRIPTION = 'List Custom Tables

Official Ramp endpoint: GET /developer/v1/custom-records/custom-tables';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/custom-records/custom-tables';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
