<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Append cells to Matrix table rows.
 *
 * Maps to the official Ramp endpoint post /developer/v1/custom-records/matrix-tables/{table_name}/rows/-/append.
 */
class RampPostDevApiMatrixAppendCells extends AbstractRampTool
{
    protected const NAME = 'ramp_post_dev_api_matrix_append_cells';
    protected const DESCRIPTION = 'Append cells to Matrix table rows

Official Ramp endpoint: POST /developer/v1/custom-records/matrix-tables/{table_name}/rows/-/append

Adds values to many-to-many result columns without replacing existing values. Only works on many-to-many result columns. Set ignore_duplicates=true to skip existing duplicate cells instead of erroring.';
    protected const PARAMETERS = array (
  'table_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `table_name` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/custom-records/matrix-tables/{table_name}/rows/-/append';
    protected const PATH_PARAMS = array (
  'table_name' => 'table_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
