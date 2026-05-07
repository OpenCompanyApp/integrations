<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Change the API name of a Native Table's Custom Record Column.
 *
 * Maps to the official Ramp endpoint patch /developer/v1/custom-records/configure/native-tables/{native_table_name}/columns/{column_name}.
 */
class RampPatchDevApiRenameNativeTableColumn extends AbstractRampTool
{
    protected const NAME = 'ramp_patch_dev_api_rename_native_table_column';
    protected const DESCRIPTION = 'Change the API name of a Native Table\'s Custom Record Column

Official Ramp endpoint: PATCH /developer/v1/custom-records/configure/native-tables/{native_table_name}/columns/{column_name}';
    protected const PARAMETERS = array (
  'native_table_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `native_table_name` from the official Ramp API operation.',
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
    protected const PATH = '/developer/v1/custom-records/configure/native-tables/{native_table_name}/columns/{column_name}';
    protected const PATH_PARAMS = array (
  'native_table_name' => 'native_table_name',
  'column_name' => 'column_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
