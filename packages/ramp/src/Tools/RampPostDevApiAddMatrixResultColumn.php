<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Add a result column to an existing Matrix table.
 *
 * Maps to the official Ramp endpoint post /developer/v1/custom-records/matrix-tables/{table_name}/columns.
 */
class RampPostDevApiAddMatrixResultColumn extends AbstractRampTool
{
    protected const NAME = 'ramp_post_dev_api_add_matrix_result_column';
    protected const DESCRIPTION = 'Add a result column to an existing Matrix table

Official Ramp endpoint: POST /developer/v1/custom-records/matrix-tables/{table_name}/columns

Allows adding result columns to already-created matrix tables without modifying the input columns. Only result columns (users and accounting_field_options) can be added. Input columns cannot be added after table creation.';
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
    protected const PATH = '/developer/v1/custom-records/matrix-tables/{table_name}/columns';
    protected const PATH_PARAMS = array (
  'table_name' => 'table_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
