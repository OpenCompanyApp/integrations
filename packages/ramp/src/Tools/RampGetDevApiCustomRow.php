<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List Custom Table rows.
 *
 * Maps to the official Ramp endpoint get /developer/v1/custom-records/custom-tables/{custom_table_name}/rows.
 */
class RampGetDevApiCustomRow extends AbstractRampTool
{
    protected const NAME = 'ramp_get_dev_api_custom_row';
    protected const DESCRIPTION = 'List Custom Table rows

Official Ramp endpoint: GET /developer/v1/custom-records/custom-tables/{custom_table_name}/rows';
    protected const PARAMETERS = array (
  'custom_table_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `custom_table_name` from the official Ramp API operation.',
  ),
  'external_key' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `external_key` from the official Ramp API operation.',
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
  'start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `start` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/custom-records/custom-tables/{custom_table_name}/rows';
    protected const PATH_PARAMS = array (
  'custom_table_name' => 'custom_table_name',
);
    protected const QUERY_PARAMS = array (
  'external_key' => 'external_key',
  'include_all_referenced_rows' => 'include_all_referenced_rows',
  'page_size' => 'page_size',
  'start' => 'start',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
