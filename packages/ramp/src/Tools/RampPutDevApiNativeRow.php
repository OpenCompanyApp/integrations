<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Set values for rows of a Native Ramp table.
 *
 * Maps to the official Ramp endpoint put /developer/v1/custom-records/native-tables/{native_table_name}/rows.
 */
class RampPutDevApiNativeRow extends AbstractRampTool
{
    protected const NAME = 'ramp_put_dev_api_native_row';
    protected const DESCRIPTION = 'Set values for rows of a Native Ramp table

Official Ramp endpoint: PUT /developer/v1/custom-records/native-tables/{native_table_name}/rows';
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
    protected const METHOD = 'put';
    protected const PATH = '/developer/v1/custom-records/native-tables/{native_table_name}/rows';
    protected const PATH_PARAMS = array (
  'native_table_name' => 'native_table_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
