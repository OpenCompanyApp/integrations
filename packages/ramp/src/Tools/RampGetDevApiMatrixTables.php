<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List all Matrix tables for the business.
 *
 * Maps to the official Ramp endpoint get /developer/v1/custom-records/matrix-tables.
 */
class RampGetDevApiMatrixTables extends AbstractRampTool
{
    protected const NAME = 'ramp_get_dev_api_matrix_tables';
    protected const DESCRIPTION = 'List all Matrix tables for the business

Official Ramp endpoint: GET /developer/v1/custom-records/matrix-tables';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/custom-records/matrix-tables';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
