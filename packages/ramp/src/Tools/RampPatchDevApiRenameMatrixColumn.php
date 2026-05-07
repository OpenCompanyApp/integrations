<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Change the API name of a Matrix table column (input or result).
 *
 * Maps to the official Ramp endpoint patch /developer/v1/custom-records/matrix-tables/{table_name}/columns/{column_name}.
 */
class RampPatchDevApiRenameMatrixColumn extends AbstractRampTool
{
    protected const NAME = 'ramp_patch_dev_api_rename_matrix_column';
    protected const DESCRIPTION = 'Change the API name of a Matrix table column (input or result)

Official Ramp endpoint: PATCH /developer/v1/custom-records/matrix-tables/{table_name}/columns/{column_name}

This changes the internal name used in API calls while preserving the human-readable label. Both input and result columns can be renamed.';
    protected const PARAMETERS = array (
  'table_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `table_name` from the official Ramp API operation.',
  ),
  'column_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `column_name` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/developer/v1/custom-records/matrix-tables/{table_name}/columns/{column_name}';
    protected const PATH_PARAMS = array (
  'table_name' => 'table_name',
  'column_name' => 'column_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
