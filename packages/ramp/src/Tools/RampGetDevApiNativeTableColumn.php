<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List Custom Columns for a Native Ramp table.
 *
 * Maps to the official Ramp endpoint get /developer/v1/custom-records/native-tables/{native_table_name}/columns.
 */
class RampGetDevApiNativeTableColumn extends AbstractRampTool
{
    protected const NAME = 'ramp_get_dev_api_native_table_column';
    protected const DESCRIPTION = 'List Custom Columns for a Native Ramp table

Official Ramp endpoint: GET /developer/v1/custom-records/native-tables/{native_table_name}/columns';
    protected const PARAMETERS = array (
  'native_table_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `native_table_name` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/custom-records/native-tables/{native_table_name}/columns';
    protected const PATH_PARAMS = array (
  'native_table_name' => 'native_table_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
