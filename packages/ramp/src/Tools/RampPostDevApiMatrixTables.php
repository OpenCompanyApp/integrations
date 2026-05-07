<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create a Matrix table.
 *
 * Maps to the official Ramp endpoint post /developer/v1/custom-records/matrix-tables.
 */
class RampPostDevApiMatrixTables extends AbstractRampTool
{
    protected const NAME = 'ramp_post_dev_api_matrix_tables';
    protected const DESCRIPTION = 'Create a Matrix table

Official Ramp endpoint: POST /developer/v1/custom-records/matrix-tables

Matrix tables are special-purpose lookup tables where unique combinations of input values map to result values.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/custom-records/matrix-tables';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
