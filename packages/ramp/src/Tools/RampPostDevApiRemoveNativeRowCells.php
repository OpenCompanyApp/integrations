<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Remove cells from a Native Ramp table.
 *
 * Maps to the official Ramp endpoint post /developer/v1/custom-records/native-tables/{native_table_name}/rows/-/remove.
 */
class RampPostDevApiRemoveNativeRowCells extends AbstractRampTool
{
    protected const NAME = 'ramp_post_dev_api_remove_native_row_cells';
    protected const DESCRIPTION = 'Remove cells from a Native Ramp table

Official Ramp endpoint: POST /developer/v1/custom-records/native-tables/{native_table_name}/rows/-/remove';
    protected const PARAMETERS = array (
  'native_table_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `native_table_name` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/custom-records/native-tables/{native_table_name}/rows/-/remove';
    protected const PATH_PARAMS = array (
  'native_table_name' => 'native_table_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
