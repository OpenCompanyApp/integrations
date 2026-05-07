<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List Native Ramp tables.
 *
 * Maps to the official Ramp endpoint get /developer/v1/custom-records/native-tables.
 */
class RampGetDevApiNativeTable extends AbstractRampTool
{
    protected const NAME = 'ramp_get_dev_api_native_table';
    protected const DESCRIPTION = 'List Native Ramp tables

Official Ramp endpoint: GET /developer/v1/custom-records/native-tables';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/custom-records/native-tables';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
