<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List Custom Column values for rows of a Native Ramp table.
 *
 * Maps to the official Ramp endpoint get /developer/v1/custom-records/native-tables/{native_table_name}/rows.
 */
class RampGetDevApiNativeRow extends AbstractRampTool
{
    protected const NAME = 'ramp_get_dev_api_native_row';
    protected const DESCRIPTION = 'List Custom Column values for rows of a Native Ramp table

Official Ramp endpoint: GET /developer/v1/custom-records/native-tables/{native_table_name}/rows';
    protected const PARAMETERS = array (
  'native_table_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `native_table_name` from the official Ramp API operation.',
  ),
  'include_all_referenced_rows' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `include_all_referenced_rows` from the official Ramp API operation.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `page_size` from the official Ramp API operation.',
  ),
  'ramp_id' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `ramp_id` from the official Ramp API operation.',
  ),
  'start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `start` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/custom-records/native-tables/{native_table_name}/rows';
    protected const PATH_PARAMS = array (
  'native_table_name' => 'native_table_name',
);
    protected const QUERY_PARAMS = array (
  'include_all_referenced_rows' => 'include_all_referenced_rows',
  'page_size' => 'page_size',
  'ramp_id' => 'ramp_id',
  'start' => 'start',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
